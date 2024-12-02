<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthentication extends Controller
{
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleResponse()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user);
                session()->put('login', $user);
                return redirect()->route('list');
            } else {
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make($googleUser->name),
                ]);

                if ($userData) {
                    Auth::login($userData);
                    session()->put('login', $userData);
                    return redirect()->route('list');
                }
                return redirect()->with(['errors' => 'Failed to login with google'])->route('login');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
