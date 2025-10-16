<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\Sponsor;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'leden');

        // Haal pending users op (niet goedgekeurde gebruikers)
        $pendingUsers = User::where('approved', false)->orderBy('created_at', 'desc')->get();

        // Haal goedgekeurde gebruikers op
        $approvedUsers = User::where('approved', true)->orderBy('first_name')->get();

        // Haal alle nieuws op
        $nieuws = News::with('author')->orderBy('created_at', 'desc')->get();

        // Haal alle sponsors op
        $sponsors = Sponsor::orderBy('name')->get();

        // Haal alle events op
        $events = Event::orderBy('date', 'desc')->get();

        return view('admin.dashboard', compact('tab', 'pendingUsers', 'approvedUsers', 'nieuws', 'sponsors', 'events'));
    }

    // Leden management
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['approved' => true]);

        return redirect()->route('admin.dashboard', ['tab' => 'leden'])
            ->with('success', 'Gebruiker is goedgekeurd!');
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_admin' => true]);

        return redirect()->route('admin.dashboard', ['tab' => 'leden'])
            ->with('success', 'Gebruiker is nu een admin!');
    }

    public function removeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_admin' => false]);

        return redirect()->route('admin.dashboard', ['tab' => 'leden'])
            ->with('success', 'Admin rechten zijn verwijderd!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'leden'])
            ->with('success', 'Gebruiker is verwijderd!');
    }

    // News management
    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'required|boolean',
        ]);

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id(),
            'published' => $request->published,
            'published_at' => $request->published ? now() : null,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'newsletter'])
            ->with('success', 'Nieuws is toegevoegd!');
    }

    public function updateNews(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'required|boolean',
        ]);

        $news = News::findOrFail($id);
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'published' => $request->published,
            'published_at' => $request->published && !$news->published_at ? now() : $news->published_at,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'newsletter'])
            ->with('success', 'Nieuws is bijgewerkt!');
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'newsletter'])
            ->with('success', 'Nieuws is verwijderd!');
    }

    // Sponsor management
    public function storeSponsor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'website' => 'nullable|url',
        ]);

        $logoPath = $request->file('logo')->store('sponsors', 'public');

        Sponsor::create([
            'name' => $request->name,
            'logo' => $logoPath,
            'website' => $request->website,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'sponsors'])
            ->with('success', 'Sponsor is toegevoegd!');
    }

    public function updateSponsor(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'website' => 'nullable|url',
        ]);

        $sponsor = Sponsor::findOrFail($id);

        $data = [
            'name' => $request->name,
            'website' => $request->website,
        ];

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($sponsor->logo && \Storage::disk('public')->exists($sponsor->logo)) {
                \Storage::disk('public')->delete($sponsor->logo);
            }
            $data['logo'] = $request->file('logo')->store('sponsors', 'public');
        }

        $sponsor->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'sponsors'])
            ->with('success', 'Sponsor is bijgewerkt!');
    }

    public function deleteSponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        // Delete logo
        if ($sponsor->logo && \Storage::disk('public')->exists($sponsor->logo)) {
            \Storage::disk('public')->delete($sponsor->logo);
        }

        $sponsor->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'sponsors'])
            ->with('success', 'Sponsor is verwijderd!');
    }

    // Event management
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.dashboard', ['tab' => 'evenementen'])
            ->with('success', 'Evenement is toegevoegd!');
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
        ]);

        $event = Event::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('poster')) {
            // Delete old poster
            if ($event->poster && \Storage::disk('public')->exists($event->poster)) {
                \Storage::disk('public')->delete($event->poster);
            }
            $data['poster'] = $request->file('poster')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'evenementen'])
            ->with('success', 'Evenement is bijgewerkt!');
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        // Delete poster
        if ($event->poster && \Storage::disk('public')->exists($event->poster)) {
            \Storage::disk('public')->delete($event->poster);
        }

        $event->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'evenementen'])
            ->with('success', 'Evenement is verwijderd!');
    }
}
