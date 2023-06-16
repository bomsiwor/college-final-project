<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    //
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        // $user = Socialite::driver('github')->user();
        // $finduser = User::where('github_id', $user->id)->first();
        // if ($finduser) {
        //     Auth::login($finduser);
        //     return redirect()->intended('dashboard');
        // } else {
        //     return view('Auth.register-by-socialite', compact('user'));
        // }
        try {
            $user = Socialite::driver('github')->user();
            $finduser = User::where('github_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {

                $data = [
                    'github_id' => $user->id,
                ];

                if (User::where('email', $user->email)->get()->isEmpty()) {
                    $data += [
                        'username' => $user->nickname,
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => Hash::make('password123'),
                        'profession_id' => 1,
                        'identifier' => 'other',
                        'identification_number' => '0000' + now()->getTimestamp(),
                        'institution_id' => 2
                    ];
                }

                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    $data
                );

                if ($newUser->wasRecentlyCreated) :
                    $newUser->assignRole('user');
                endif;

                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
