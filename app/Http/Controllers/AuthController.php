<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivateAccountRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Mail\AuthMail;
use App\Mail\VerifyMail;
use App\Models\Staff;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    /**
     * Attempt to log in a user.
     * @param email string The user's email address.
     * @param password string The user's password.
     * @param role_id int The user's role ID.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the verification code page.
     */
    public function login(Request $request) {
        Log::info('Login attempt started.');

        $loginData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        Log::info('Login data validated.', ['email' => $loginData['email']]);

        $user = Staff::where('email', $loginData['email'])->first();

        if (!$user) {
            Log::warning('User not found.', ['email' => $loginData['email']]);
            return back()->withErrors(['credentials' => 'Invalid email or password.'])->withInput();
        }

        Log::info('User found.', ['email' => $loginData['email'], 'staff_id' => $user->staff_id]);

        
        if (sha1($loginData['password']) !== $user->password) {
            Log::warning('Invalid password.', ['email' => $loginData['email']]);
            return back()->withErrors(['credentials' => 'Invalid email or password.'])->withInput();
        }

        Log::info('Password verified successfully.', ['email' => $loginData['email']]);

        $tempCode = rand(100000, 999999);
        $user->temp_code = Hash::make($tempCode); 
        $user->last_update = now();
        $user->save();

        Log::info('Temporary code generated and saved.', ['email' => $loginData['email'], 'temp_code' => $tempCode]);

        $encryptedId = Crypt::encryptString($user->staff_id);

        if ($user->active === 1) {
            Log::info('User is active. Sending verification email.', ['email' => $loginData['email']]);
            Mail::to($user->email)->send(new VerifyMail($user->first_name, $tempCode));

            Log::info('Verification email sent.', ['email' => $loginData['email']]);
            return redirect()->route('User.code_verify');
        }

        Log::info('User is inactive. Sending account activation email.', ['email' => $loginData['email']]);

        $activateAccountUrl = URL::temporarySignedRoute('activate-account', now()->addMinutes(15), [
            'staff_id' => $encryptedId
        ]);

        Mail::to($user->email)->send(new AuthMail($user->first_name, $activateAccountUrl));

        Log::info('Account activation email sent.', ['email' => $loginData['email']]);

        return back()->with('message', 'Check your email to activate your account.');
    }
    

    /**
     * Check if the user's verification code is correct.
     * 
     * @param staff_id string The user's ID encrypted with the Crypt facade.
     * @param temp_code int The user's verification code.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the home page.
     */
    public function verifyCode(Request $request) {
        Log::info('Verification code process started.');
        
        $verifyData = $request->validate([
            'temp_code' => 'required|string|min:6|max:6',
            'type' => 'required|string'
        ]);
    
        try {
            
            $user = Staff::where('temp_code', Hash::check($verifyData['temp_code'], $verifyData['temp_code']))
                        ->first();
            if (!$user) {
                Log::warning('User not found with the provided verification code.');
                return back()->withErrors(['temp_code' => 'Incorrect verification code or user not found.']);
            }
    
            Log::info('User found.', ['staff_id' => $user->staff_id, 'email' => $user->email]);
    
            // Limpiar el código temporal y actualizar el timestamp
            $user->update(['temp_code' => null, 'last_update' => now()]);
            Log::info('Temporary code cleared and last update timestamp updated.', ['staff_id' => $user->staff_id]);
    
            return tap(
                redirect()->route('index')->withCookie(
                    cookie('token', JWTAuth::fromUser($user), 1440, null, null, true, true, false, 'Strict')
                ),
                fn() => Log::info('User logged in successfully.', ['staff_id' => $user->staff_id])
            );
        } catch (\Exception $e) {
            Log::error('Verification failed.', ['error' => $e->getMessage()]);
            return back()->withErrors(['general' => 'An error occurred while verifying the code.']);
        }
    }
    

    /*----------------------------------------------------------------------------------------------------*/

    /**
     * Attempt to add a new user to the database.
     * @param first_name string The user's name.
     * @param last_name string The user's last name.
     * @param email string The user's email address.
     * @param password string The user's password.
     * @param username string The user's username.
     * @param address_id int The user's address ID.
     * @param store_id int The user's store ID.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the sign-in page.
     */
    public function register(Request $request)
    {
        Log::info('Starting staff registration.');

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255', 'min:3', 'regex:/^[a-zA-Z\s]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'min:3', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:staff,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
                'confirmed',
            ],
            'username' => 'required|string|min:3|max:50',
            'address_id' => 'required|integer',
            'store_id' => 'required|integer',
            'password_confirmation' => 'required|string|min:8|max:20',
        ], [
            'first_name.required' => 'The first name field is required.',
            'first_name.min' => 'The first name must be at least 3 characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.min' => 'The last name must be at least 3 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'h-captcha-response.required' => 'Please verify that you are not a robot.',
        ]);

        
        if ($validator->fails()) {
            Log::warning('Validation failed.', $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }

        $staff = Staff::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => sha1($request['password']),
            'username' => $request->input('username'),
            'address_id' => $request->input('address_id'),
            'store_id' => $request->input('store_id'),
            'role_id' => 2,
            'active' => 0,
            'last_update' => now(),
        ]);

        $encryptedId = Crypt::encryptString($staff->staff_id);
        $activateAccountUrl = URL::temporarySignedRoute('activate-account', now()->addMinutes(15), [
            'staff_id' => $encryptedId
        ]);
        
        Mail::to($staff->email)->send(new AuthMail($staff->first_name, $activateAccountUrl));

        return redirect()->route('User.login');
    }

    /**
     * Check if the user's verification code is correct.
     * 
     * @param staff_id string The user's ID encrypted with the Crypt facade.
     * @param temp_code int The user's verification code.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the home page.
     */
    public function activateAccount($staff_id)
    {
        try {
            $staffId = Crypt::decryptString($staff_id);

            $staff = Staff::findOrFail($staffId);

            $staff->active = 1;
            $staff->save();

            return redirect()->route('User.login')->with('status', 'Account activated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('User.login')->with('error', 'The activation link is invalid or expired.');
        }
    }

    /*----------------------------------------------------------------------------------------------------*/

    /**
     * Send a verification code to the user's email for password recovery.
     * 
     * @param email string The user's email address.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the verification code page.
     */
    public function forgotPassword(ForgotPasswordRequest $request) {
        // Validate the request data
        $formData = $request->validated();

        // Get the user from the database by email
        $user = Staff::where('email', $formData['email'])->and('role_id', 2)->first();

        // Check if the user was not found
        if (!$user)
            return back()->withErrors(['email' => 'User not found.']);

        // Generate a random 6-digit verification code
        $tempCode = rand(100000, 999999);

        // Save the verification code to the user's record
        $user->temp_code = Hash::make($tempCode);
        $user->last_update = now();
        $user->save();

        // Send the verification code to the user's email
        Mail::to($user->email)->send(new AuthMail($user->first_name, $tempCode));

        // Encrypt the user's ID
        $encryptedId = Crypt::encryptString($user->staff_id);

        // Generate a signed URL for the verification code page
        $verifyCodeUrl = URL::temporarySignedRoute('verify-code', now()->addMinutes(15), [
            'staff_id' => $encryptedId,
            'type' => 'recovery'
        ]);

        // Redirect the user to the verification code page
        return redirect($verifyCodeUrl);
    }

    /**
     * Change the user's password.
     * 
     * @param staff_id string The user's ID encrypted with the Crypt facade.
     * @param password string The user's new password.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the sign-in page.
     */
    public function changePassword(ChangePasswordRequest $request) {
        // Validate the request data
        $formData = $request->validated();

        // Decrypt the user ID
        $staffId = (int) Crypt::decryptString($formData['staff_id']);
        $user = Staff::where('staff_id', $staffId)->and('role_id', 2)->first();

        // Check if the user exists
        if (!$user)
            return back()->withErrors(['staff_id' => 'User not found.']);

        // Update the user's password
        $user->password = sha1($formData['password']);
        $user->last_update = now();
        $user->save();

        return redirect()->route('sign-in')->with('success', 'Password changed successfully.');
    }

    /*----------------------------------------------------------------------------------------------------*/

    /**
     * Attempt to log out a user.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the sign-in page.
     */
    public function logout() {
        // Invalidates the JWT token
        JWTAuth::invalidate(JWTAuth::getToken());

        // Forgets the token cookie
        $cookie = Cookie::forget('token');

        // Redirect the user to the sign-in page
        return redirect()->route('sign-in')->withCookie($cookie);
    }
}