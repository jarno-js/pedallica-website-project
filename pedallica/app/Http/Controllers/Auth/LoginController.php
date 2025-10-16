<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Toon het inlogformulier
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Log de gebruiker in
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Probeer in te loggen
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Check of de gebruiker is goedgekeurd door een admin
            if (!$user->approved) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Je account is nog niet goedgekeurd door een admin. Je ontvangt een bericht zodra je account is goedgekeurd.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Welkom terug, ' . $user->first_name . '!');
        }

        return back()->withErrors([
            'email' => 'De opgegeven inloggegevens zijn onjuist.',
        ])->onlyInput('email');
    }

    /**
     * Log de gebruiker uit
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Je bent succesvol uitgelogd.');
    }
}
