<?php

use Illuminate\Support\Facades\Http;

const H_CAPTCHA_URL = 'https://api.hcaptcha.com/siteverify';

/**
 * Verify the hCaptcha response.
 * 
 * @param string $h_captcha_response
 * @return array The response from the hCaptcha API.
 */
if (!function_exists('verifyCaptcha')) {
    function verifyCaptcha(string $h_captcha_response): array {
        $response = Http::asForm()->post(H_CAPTCHA_URL, [
            'secret' => env('HCAPTCHA_SECRET'),
            'response' => $h_captcha_response,
        ]);

        return $response->json();
    }
}