<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{
    /**
     * Redirect to provider (Google/Facebook)
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Handle callback from provider
     */
    public function callback($provider)
    {
        try {
            // Retrieve user from provider
            $socialUser = Socialite::driver($provider)->user();
    
            // Check if user exists in DB
            $user = User::where('social_id', $socialUser->getId())
                        ->where('social_provider', $provider)
                        ->first();
    
            if (!$user) {
                // Check if email exists but no social ID
                $user = User::where('email', $socialUser->getEmail())->first();
    
                if ($user) {
                    // Existing user, update social details
                    $user->update([
                        'social_id' => $socialUser->getId(),
                        'social_provider' => $provider,
                    ]);
    
                    session()->flash('status', "You are logged in with {$provider}!");
                } else {
                    // New user, create an account
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'social_id' => $socialUser->getId(),
                        'social_provider' => $provider,
                        'password' => Hash::make(uniqid()), // Set a random password
                    ]);
    
                    session()->flash('status', "You are signed up with {$provider}!");
                }
            } else {
                session()->flash('status', "You are logged in with {$provider}!");
            }
    
            // Authenticate user
            Auth::login($user);
    
            return redirect('/home');
    
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Failed to login: ' . $e->getMessage());
        }
    }
    
}
