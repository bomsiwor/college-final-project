<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LinkedinController extends Controller
{
    //
    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function linkedinCallback()
    {
        try {

            $user = Socialite::driver('linkedin')->user();

            $linkedinUser = User::where('linkedin_id', $user->id)->first();

            if ($linkedinUser) {

                Auth::login($linkedinUser);

                return redirect('/dashboard');
            } else {
                $data = [

                    'linkedin_id' => $user->id,
                    // 'oauth_type' => 'linkedin',

                ];

                if (User::where('email', $user->email)->get()->isEmpty()) :
                    $data += [
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => Hash::make('password'),
                        'username' => $user->first_name . now()->getTimestamp(),
                        'profession_id' => 1,
                        'identifier' => 'other',
                        'identification_number' => '0000' + now()->getTimestamp(),
                        'institution_id' => 2
                    ];
                endif;
                $newuser = User::updateOrCreate(['email' => $user->email], $data);

                if ($newuser->wasRecentlyCreated) :
                    $newuser->assignRole('user');
                endif;

                Auth::login($newuser);

                return redirect('/dashboard');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
