<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();            
            $user = Staff::where('email', $googleUser->getEmail())->first();
            if(!$user){
                $user = Staff::create([
                    'first_name'=>$googleUser->getName(),
                    'email'=> $googleUser->getEmail(),
                    'google_id'=>$googleUser->getId(),
                    'last_name'=>'',
                    'address_id'=>1,
                    'store_id'=>1,
                    'username'=> '',
                    'role_id'=>2,
                    'password'=>sha1('12345678')
                ]);
            }
            return redirect()->route('User.code_verify');
        } catch (Exception $error) {
            Log::error($error->getMessage());
            return redirect()->route('User.login');            
        }
    }
}
