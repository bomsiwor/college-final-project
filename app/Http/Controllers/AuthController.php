<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profession;
use App\Mail\ResetPassword;
use App\Models\Institution;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->to('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {

                $data = [
                    'google_id' => $user->id,
                ];

                if (User::where('email', $user->email)->get()->isEmpty()) {
                    $data += [
                        'username' => ($user->nickname ?? Str::lower($user->name) . now()->getTimestamp()),
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => Hash::make('password123'),
                        'profession_id' => 1,
                        'identifier' => 'other',
                        'identification_number' => '0000' . now()->getTimestamp(),
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

    public function resetPassword(Request $request)
    {
        $title = 'Reset Kata sandi';

        return view('Auth.reset-password', compact('title'));
    }

    public function resetPasswordForm(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $realPassword = strtolower(Str::random(6));
        $password = Hash::make($realPassword);
        $user = User::where('email', $request->email)->first();
        Mail::to($user->email)->send(new ResetPassword($realPassword));
        $user->password = $password;
        $user->save();

        return back()->with('success', "Sukses");
    }
}
