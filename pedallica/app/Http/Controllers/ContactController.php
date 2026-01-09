<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    /**
     * Toon het contact formulier
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Verstuur het contact formulier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // Verstuur email naar admin
        try {
            Mail::to('admin@ehb.be')->send(new ContactFormMail($validated));

            return redirect()->route('contact')->with('success', 'Je bericht is succesvol verzonden! We nemen zo snel mogelijk contact met je op.');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'Er is iets misgegaan bij het verzenden van je bericht. Probeer het later opnieuw of stuur een email naar pedallica@outlook.be');
        }
    }
}
