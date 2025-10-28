<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Toon het registratieformulier
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Registreer een nieuwe gebruiker
     */
    public function register(Request $request)
    {
        // Validatie van alle velden
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'street' => ['required', 'string', 'max:255'],
            'house_number' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Converteer datum van dd/mm/yyyy naar Y-m-d
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $validated['birth_date'], $matches)) {
            $validated['birth_date'] = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }

        // Maak nieuwe gebruiker aan (zonder profielfoto eerst, approved = false)
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'birth_date' => $validated['birth_date'],
            'phone' => $validated['phone'],
            'street' => $validated['street'],
            'house_number' => $validated['house_number'],
            'postal_code' => $validated['postal_code'],
            'city' => $validated['city'],
            'country' => $validated['country'],
            'approved' => false,
        ]);

        // Verwerk profielfoto als deze is geüpload (nu met user ID)
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = strtolower($validated['first_name'] . $validated['last_name']) . '-' . $user->id . '.' . $file->getClientOriginalExtension();

            // Verplaats bestand naar public folder
            $file->move(public_path(), $filename);

            // Update user met profielfoto path
            $user->update(['profile_picture' => $filename]);
        }

        // Zorg ervoor dat gebruiker NIET automatisch wordt ingelogd
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect naar login pagina met succesbericht (NIET naar home, om verwarring te voorkomen)
        return redirect()->route('login')->with('success', 'Account succesvol aangemaakt! Je account moet nog goedgekeurd worden door een admin voordat je kan inloggen. Je ontvangt hierover bericht.');
    }
}
