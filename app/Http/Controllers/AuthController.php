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
    public function login(LoginRequest $request) {
        // Get validated user data
        $formData = $request->validated();

        // Verify the hCaptcha response token with the hCaptcha API
        $captchaResponse = verifyCaptcha($formData['h-captcha-response']);

        // Check if the hCaptcha verification failed
        if (!$captchaResponse['success'])
            return back()->withErrors(['h-captcha-response' => 'Captcha verification failed.']);

        // Get the user from the database by email
        $user = Staff::where('email', $formData['email'])->and('role_id', $formData['role_id'])->first();

        // Check if the user was not found or the password is incorrect
        if (!$user || !sha1($formData['password']) === $user->password)
            return back()->withErrors(['credentials' => 'Invalid email or password.'])->withInput();

        // Generate a random 6-digit verification code
        $tempCode = rand(100000, 999999);

        // Save the verification code to the user's record
        $user->temp_code = Hash::make($tempCode);
        $user->last_update = now();
        $user->save();

        // Check if the user's email is not verified
        if ($user->active === 1) {
            // Send the verification code to the user's email
            Mail::to($user->email)->send(new VerifyMail($user->first_name, $tempCode));

            // Encrypt the user's ID
            $encryptedId = Crypt::encryptString($user->staff_id);

            // Generate a signed URL for the account activation page
            $activateAccountUrl = URL::temporarySignedRoute('activate-account', now()->addMinutes(15), [
                'staff_id' => $encryptedId
            ]);

            // Redirect the user to the account activation page
            return redirect($activateAccountUrl);
        }

        // Send the verification code to the user's email
        Mail::to($user->email)->send(new AuthMail($user->first_name, $tempCode));

        // Encrypt the user's ID
        $encryptedId = Crypt::encryptString($user->staff_id);

        // Generate a signed URL for the verification code page
        $verifyCodeUrl = URL::temporarySignedRoute('verify-code', now()->addMinutes(15), [
            'staff_id' => $encryptedId
        ]);

        // Redirect the user to the verification code page
        return redirect($verifyCodeUrl);
    }

    /**
     * Check if the user's verification code is correct.
     * 
     * @param staff_id string The user's ID encrypted with the Crypt facade.
     * @param temp_code int The user's verification code.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the home page.
     */
    public function verifyCode(VerifyCodeRequest $request) {
        // Validate the request data
        $formData = $request->validated();

        $staffId = (int) Crypt::decryptString($formData['staff_id']); // Decrypt the user ID
        $user = Staff::where('staff_id', $staffId)->and('role_id', 2)->first(); // Get the user from the database

        // Check if the user exists
        if (!$user)
            return back()->withErrors(['staff_id' => 'User not found.']);

        // Check if the verification code is correct
        if (!Hash::check($formData['temp_code'], $user->temp_code))
            return back()->withErrors(['temp_code' => 'The verification code is incorrect.'])->withInput();

        // Remove the verification code
        $user->temp_code = null;
        $user->last_update = now();
        $user->save();

        if ($formData['type'] === 'login') {
            $token = JWTAuth::fromUser($user); // Generate a JWT token for the user
            $cookie = cookie('token', $token, 60 * 24, null, null, true, true, false, 'Strict'); // Create a cookie with the JWT token

            // Redirect the user to the home page
            return redirect()->route('home')->withCookie($cookie);
        }

        else if ($formData['type'] === 'recovery') {
            $encryptedId = Crypt::encryptString($user->staff_id); // Encrypt the user's ID

            // Generate a signed URL for the change password page
            $changePasswordUrl = URL::temporarySignedRoute('change-password', now()->addMinutes(15), [
                'staff_id' => $encryptedId
            ]);

            return redirect($changePasswordUrl);
        }

        return redirect()->route('sign-in');
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
    public function register(RegisterRequest $request) {
        // Get validated user data
        $formData = $request->validated();

        // Verify the hCaptcha response token with the hCaptcha API
        $captchaResponse = verifyCaptcha($formData['h-captcha-response']);

        // Check if the hCaptcha verification failed
        if (!$captchaResponse['success'])
            return back()->withErrors(['h-captcha-response' => 'Captcha verification failed.']);

        // Create a new user
        $user = Staff::create([
            'first_name' => $formData['first_name'],
            'second_name' => $formData['second_name'],
            'last_name' => $formData['last_name'],
            'address_id' => $formData['address_id'],
            'email' => $formData['email'],
            'store_id' => $formData['store_id'],
            'active' => 0,
            'username' => $formData['username'],
            'password' => sha1($formData['password']),
            'role_id' => 2,
        ]);

        // Check if the user was not created
        if (!$user)
            return back()->withErrors(['registration' => 'Failed to register user.'])->withInput();

        // Encrypt the user's ID
        $encryptedId = Crypt::encryptString($user->staff_id);

        // Generate a signed URL for the account activation page
        $activateAccountUrl = URL::temporarySignedRoute('activate-account', now()->addMinutes(15), [
            'staff_id' => $encryptedId
        ]);

        // Redirect the user to the account activation page
        return redirect($activateAccountUrl);
    }

    /**
     * Check if the user's verification code is correct.
     * 
     * @param staff_id string The user's ID encrypted with the Crypt facade.
     * @param temp_code int The user's verification code.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the home page.
     */
    public function activateAccount(ActivateAccountRequest $request) {
        // Validate the request data
        $formData = $request->validated();

        // Decrypt the user ID
        $staffId = (int) Crypt::decryptString($formData['staff_id']); // Decrypt the user ID
        $user = Staff::where('staff_id', $staffId)->and('role_id', 2)->first(); // Get the user from the database

        // Check if the user exists
        if (!$user)
            return back()->withErrors(['staff_id' => 'User not found.']);

        // Check if the verification code is correct
        if (!Hash::check($formData['temp_code'], $user->temp_code))
            return back()->withErrors(['temp_code' => 'The verification code is incorrect.'])->withInput();

        // Remove the verification code and verify the user's email
        $user->temp_code = null;
        $user->active = 1;
        $user->last_update = now();
        $user->save();

        // Redirect the user to the sign-in page
        return redirect()->route('sign-in')->with('success', 'User account activated successfully.');
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