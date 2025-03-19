<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivateAccountRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Mail\AuthMail;
use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     * Attempt to log in a user.
     * @param email string The user's email address.
     * @param password string The user's password.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the verification code page.
     */
    public function login(LoginRequest $request)
    {
        // Get validated user data
        $formData = $request->validated();

        // Verify the hCaptcha response token with the hCaptcha API
        $captchaResponse = verifyCaptcha($formData['h-captcha-response']);

        // Check if the hCaptcha verification failed
        if (!$captchaResponse['success'])
            return back()->withErrors(['h-captcha-response' => 'Captcha verification failed.']);

        // Get the user from the database by email
        $user = User::where('email', $formData['email'])->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($formData['password'], $user->password))
            return back()->withErrors(['credentials' => 'Invalid email or password.'])->withInput();

        // Generate a random 6-digit verification code
        $verificationCode = rand(100000, 999999);

        // Save the verification code to the user's record
        $user->verification_code = Hash::make($verificationCode);
        $user->save();

        // Check if the user's email is not verified
        if ($user->email_verified_at === null) {
            // Send the verification code to the user's email
            Mail::to($user->email)->send(new VerifyMail($user->first_name, $verificationCode));

            // Encrypt the user's ID
            $encryptedId = Crypt::encryptString($user->id);

            // Generate a signed URL for the account activation page
            $activateAccountUrl = URL::temporarySignedRoute('activate-account', now()->addMinutes(15), [
                'id' => $encryptedId
            ]);

            // Redirect the user to the account activation page
            return redirect($activateAccountUrl);
        }

        // Send the verification code to the user's email
        Mail::to($user->email)->send(new AuthMail($user->first_name, $verificationCode));

        // Encrypt the user's ID
        $encryptedId = Crypt::encryptString($user->id);

        // Generate a signed URL for the verification code page
        $verifyCodeUrl = URL::temporarySignedRoute('verify-code', now()->addMinutes(15), [
            'id' => $encryptedId
        ]);

        // Redirect the user to the verification code page
        return redirect($verifyCodeUrl);
    }

    /**
     * Check if the user's verification code is correct.
     * 
     * @param id string The user's ID encrypted with the Crypt facade.
     * @param verification-code int The user's verification code.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the home page.
     */
    public function verifyCode(VerifyCodeRequest $request) {
        // Validate the request data
        $formData = $request->validated();

        // Verify the hCaptcha response token with the hCaptcha API
        $captchaResponse = verifyCaptcha($formData['h-captcha-response']);

        // Check if the hCaptcha verification failed
        if (!$captchaResponse['success'])
            return back()->withErrors(['h-captcha-response' => 'Captcha verification failed.']);

        $userId = (int) Crypt::decryptString($formData['id']); // Decrypt the user ID
        $user = User::where('id', $userId)->first(); // Get the user from the database

        // Check if the user exists
        if (!$user)
            return back()->withErrors(['id' => 'User not found.']);

        // Check if the verification code is correct
        if (!Hash::check($formData['verification-code'], $user->verification_code))
            return back()->withErrors(['verification-code' => 'The verification code is incorrect.'])->withInput();

        // Remove the verification code
        $user->verification_code = null;
        $user->save();

        // Log the user in
        Auth::login($user);

        // Redirect the user to the home page
        return redirect()->route('home');
    }

    /*----------------------------------------------------------------------------------------------------*/

    /**
     * Attempt to add a new user to the database.
     * @param name string The user's name.
     * @param second_name string The user's second name.
     * @param last_name string The user's last name.
     * @param email string The user's email address.
     * @param password string The user's password.
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
        $user = User::create([
            'first_name' => $formData['first_name'],
            'second_name' => $formData['second_name'],
            'last_name' => $formData['last_name'],
            'email' => $formData['email'],
            'password' => Hash::make(trim($formData['password']))
        ]);

        // Check if the user was not created
        if (!$user)
            return back()->withErrors(['registration' => 'Failed to register user.'])->withInput();

        // Encrypt the user's ID
        $encryptedId = Crypt::encryptString($user->id);

        // Generate a signed URL for the account activation page
        $activateAccountUrl = URL::temporarySignedRoute('activate-account', now()->addMinutes(15), [
            'id' => $encryptedId
        ]);

        // Redirect the user to the account activation page
        return redirect($activateAccountUrl);
    }

    /**
     * Check if the user's verification code is correct.
     * 
     * @param id string The user's ID encrypted with the Crypt facade.
     * @param verification-code int The user's verification code.
     * @param h-captcha-response string The hCaptcha response token.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the home page.
     */
    public function activateAccount(ActivateAccountRequest $request) {
        // Validate the request data
        $formData = $request->validated();

        // Verify the hCaptcha response token with the hCaptcha API
        $captchaResponse = verifyCaptcha($formData['h-captcha-response']);

        // Check if the hCaptcha verification failed
        if (!$captchaResponse['success'])
            return back()->withErrors(['h-captcha-response' => 'Captcha verification failed.']);

        $userId = (int) Crypt::decryptString($formData['id']); // Decrypt the user ID
        $user = User::where('id', $userId)->first(); // Get the user from the database

        // Check if the user exists
        if (!$user)
            return back()->withErrors(['id' => 'User not found.']);

        // Check if the verification code is correct
        if (!Hash::check($formData['verification-code'], $user->verification_code))
            return back()->withErrors(['verification-code' => 'The verification code is incorrect.'])->withInput();

        // Remove the verification code and verify the user's email
        $user->verification_code = null;
        $user->email_verified_at = now();
        $user->save();

        // Redirect the user to the sign-in page
        return redirect()->route('sign-in')->with('success', 'User account activated successfully.');
    }

    /*----------------------------------------------------------------------------------------------------*/

    /**
     * Attempt to log out a user.
     * @return \Illuminate\Http\RedirectResponse Redirect the user to the sign-in page.
     */
    public function logout() {
        Auth::logout(); // Log the user out
        
        session()->forget('user_id'); // Delete the user ID from the session
        session()->invalidate(); // Invalidate the session
        session()->regenerateToken(); // Regenerate the CSRF token

        // Redirect the user to the sign-in page
        return redirect()->route('sign-in');
    }
}