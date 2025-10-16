<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfielController extends Controller
{
    /**
     * Toon het profiel van de ingelogde gebruiker
     */
    public function show()
    {
        $user = Auth::user();
        return view('profiel', compact('user'));
    }

    /**
     * Update het profiel van de gebruiker
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'street' => ['nullable', 'string', 'max:255'],
            'house_number' => ['nullable', 'string', 'max:10'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'city' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
        ]);

        $user->update($validated);

        return redirect()->route('profiel')->with('success', 'Je profiel is succesvol bijgewerkt!');
    }

    /**
     * Update het wachtwoord van de gebruiker
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Controleer of het huidige wachtwoord correct is
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Het huidige wachtwoord is onjuist.',
            ]);
        }

        // Update het wachtwoord
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profiel')->with('success', 'Je wachtwoord is succesvol gewijzigd!');
    }

    /**
     * Update de profielfoto van de gebruiker
     */
    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
        ]);

        // Verwijder oude profielfoto indien aanwezig
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Upload nieuwe foto
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        $user->update([
            'profile_picture' => $path,
        ]);

        return redirect()->route('profiel')->with('success', 'Je profielfoto is succesvol bijgewerkt!');
    }

    /**
     * Verwijder de profielfoto van de gebruiker
     */
    public function deleteProfilePicture()
    {
        $user = Auth::user();

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->update([
            'profile_picture' => null,
        ]);

        return redirect()->route('profiel')->with('success', 'Je profielfoto is succesvol verwijderd!');
    }
}
