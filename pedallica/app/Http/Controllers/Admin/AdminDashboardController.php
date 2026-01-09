<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sponsor;
use App\Models\Event;
use App\Models\Rit;
use App\Models\Ploeg;
use App\Models\Faq;
use App\Models\FaqCategory;
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

        // Haal alle sponsors op
        $sponsors = Sponsor::orderBy('name')->get();

        // Haal alle events op
        $events = Event::orderBy('date', 'desc')->get();

        // Haal alle ritten op met ploeg informatie
        $ritten = Rit::with('ploeg')->orderBy('date', 'desc')->get();

        // Haal alle ploegen op voor dropdown (in logische volgorde)
        $ploegen = Ploeg::orderByRaw("FIELD(slug, 'pedallica-a', 'pedallica-b', 'pedallica-c', 'mtb', 'pedallicava')")->get();

        // Haal alle FAQ categorieën en FAQs op
        $faqCategories = FaqCategory::with('faqs')->ordered()->get();
        $allFaqs = Faq::with('category')->ordered()->get();

        return view('admin.dashboard', compact('tab', 'pendingUsers', 'approvedUsers', 'sponsors', 'events', 'ritten', 'ploegen', 'faqCategories', 'allFaqs'));
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

    // Sponsor management
    public function storeSponsor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'website' => 'nullable|url',
        ]);

        // Create sponsor first to get ID
        $sponsor = Sponsor::create([
            'name' => $request->name,
            'website' => $request->website,
        ]);

        // Upload logo with sponsor name and ID
        if ($request->hasFile('logo')) {
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = \Str::slug($sponsor->name) . '-' . $sponsor->id . '.' . $extension;
            $request->file('logo')->move(public_path('uploads/sponsors/logos'), $filename);
            $sponsor->update(['logo' => 'uploads/sponsors/logos/' . $filename]);
        }

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
            if ($sponsor->logo && file_exists(public_path($sponsor->logo))) {
                unlink(public_path($sponsor->logo));
            }

            // Upload new logo with sponsor name and ID
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = \Str::slug($request->name) . '-' . $sponsor->id . '.' . $extension;
            $request->file('logo')->move(public_path('uploads/sponsors/logos'), $filename);
            $data['logo'] = 'uploads/sponsors/logos/' . $filename;
        }

        $sponsor->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'sponsors'])
            ->with('success', 'Sponsor is bijgewerkt!');
    }

    public function deleteSponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        // Delete logo
        if ($sponsor->logo && file_exists(public_path($sponsor->logo))) {
            unlink(public_path($sponsor->logo));
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
            'date' => 'required|string',
            'location' => 'nullable|string|max:255',
        ]);

        // Converteer datum van dd/mm/yyyy naar Y-m-d
        $date = $request->date;
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $date, $matches)) {
            $date = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }

        // Create event first to get ID
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $date,
            'start_date' => $date,
            'end_date' => $date,
            'location' => $request->location,
        ]);

        // Upload poster with event name and ID
        if ($request->hasFile('poster')) {
            $extension = $request->file('poster')->getClientOriginalExtension();
            $filename = \Str::slug($event->title) . '-' . $event->id . '.' . $extension;
            $request->file('poster')->move(public_path('uploads/evenementen/posters'), $filename);
            $event->update(['poster' => 'uploads/evenementen/posters/' . $filename]);
        }

        // Check if event has passed
        $event->checkIfPassed();

        return redirect()->route('admin.dashboard', ['tab' => 'evenementen'])
            ->with('success', 'Evenement is toegevoegd!');
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => 'nullable|string',
            'date' => 'required|string',
            'location' => 'nullable|string|max:255',
        ]);

        $event = Event::findOrFail($id);

        // Converteer datum van dd/mm/yyyy naar Y-m-d
        $date = $request->date;
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $date, $matches)) {
            $date = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $date,
            'start_date' => $date,
            'end_date' => $date,
            'location' => $request->location,
        ];

        if ($request->hasFile('poster')) {
            // Delete old poster
            if ($event->poster && file_exists(public_path($event->poster))) {
                unlink(public_path($event->poster));
            }

            // Upload new poster with event name and ID
            $extension = $request->file('poster')->getClientOriginalExtension();
            $filename = \Str::slug($request->title) . '-' . $event->id . '.' . $extension;
            $request->file('poster')->move(public_path('uploads/evenementen/posters'), $filename);
            $data['poster'] = 'uploads/evenementen/posters/' . $filename;
        }

        $event->update($data);

        // Check if event has passed
        $event->checkIfPassed();

        return redirect()->route('admin.dashboard', ['tab' => 'evenementen'])
            ->with('success', 'Evenement is bijgewerkt!');
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        // Delete poster
        if ($event->poster && file_exists(public_path($event->poster))) {
            unlink(public_path($event->poster));
        }

        $event->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'evenementen'])
            ->with('success', 'Evenement is verwijderd!');
    }

    // Rit management
    public function storeRit(Request $request)
    {
        try {
            $validated = $request->validate([
                'ploeg_id' => 'required|exists:ploegs,id',
                'title' => 'required|string|max:255',
                'route_name' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'date' => 'required|string',
                'start_time' => 'nullable',
                'location' => 'nullable|string|max:255',
                'start_address' => 'nullable|string|max:255',
                'distance' => 'nullable|integer',
                'elevation_gain' => 'nullable|integer',
                'download_link' => 'nullable|url',
                'gpx_file' => 'nullable|file|max:5120',
                'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            ]);

            $data = $validated;

            // Converteer datum van dd/mm/yyyy naar Y-m-d
            if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $data['date'], $matches)) {
                $data['date'] = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
            }

            if ($request->hasFile('gpx_file')) {
                $filename = time() . '-' . $request->file('gpx_file')->getClientOriginalName();
                $request->file('gpx_file')->move(public_path('uploads/ritten/gpx'), $filename);
                $data['gpx_file'] = 'uploads/ritten/gpx/' . $filename;
            }

            if ($request->hasFile('photo')) {
                $filename = time() . '-' . $request->file('photo')->getClientOriginalName();
                $request->file('photo')->move(public_path('uploads/ritten/photos'), $filename);
                $data['photo'] = 'uploads/ritten/photos/' . $filename;
            }

            $rit = Rit::create($data);

            \Log::info('Rit created successfully', ['rit_id' => $rit->id, 'title' => $rit->title]);

            return redirect()->route('admin.dashboard', ['tab' => 'ritten'])
                ->with('success', 'Rit is toegevoegd!');
        } catch (\Exception $e) {
            \Log::error('Error creating rit', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('admin.dashboard', ['tab' => 'ritten'])
                ->with('error', 'Fout bij het toevoegen van de rit: ' . $e->getMessage());
        }
    }

    public function updateRit(Request $request, $id)
    {
        $validated = $request->validate([
            'ploeg_id' => 'required|exists:ploegs,id',
            'title' => 'required|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|string',
            'start_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'start_address' => 'nullable|string|max:255',
            'distance' => 'nullable|integer',
            'elevation_gain' => 'nullable|integer',
            'download_link' => 'nullable|url',
            'gpx_file' => 'nullable|file|max:5120',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $rit = Rit::findOrFail($id);
        $data = $validated;

        // Converteer datum van dd/mm/yyyy naar Y-m-d
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $data['date'], $matches)) {
            $data['date'] = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }

        if ($request->hasFile('gpx_file')) {
            // Delete old GPX file
            if ($rit->gpx_file && file_exists(public_path($rit->gpx_file))) {
                unlink(public_path($rit->gpx_file));
            }
            $filename = time() . '-' . $request->file('gpx_file')->getClientOriginalName();
            $request->file('gpx_file')->move(public_path('uploads/ritten/gpx'), $filename);
            $data['gpx_file'] = 'uploads/ritten/gpx/' . $filename;
        }

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($rit->photo && file_exists(public_path($rit->photo))) {
                unlink(public_path($rit->photo));
            }
            $filename = time() . '-' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('uploads/ritten/photos'), $filename);
            $data['photo'] = 'uploads/ritten/photos/' . $filename;
        }

        $rit->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'ritten'])
            ->with('success', 'Rit is bijgewerkt!');
    }

    public function deleteRit($id)
    {
        $rit = Rit::findOrFail($id);

        // Delete GPX file
        if ($rit->gpx_file && file_exists(public_path($rit->gpx_file))) {
            unlink(public_path($rit->gpx_file));
        }

        // Delete photo
        if ($rit->photo && file_exists(public_path($rit->photo))) {
            unlink(public_path($rit->photo));
        }

        $rit->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'ritten'])
            ->with('success', 'Rit is verwijderd!');
    }

    // FAQ Category management
    public function storeFaqCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        FaqCategory::create([
            'name' => $request->name,
            'order' => FaqCategory::count(),
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'faq'])
            ->with('success', 'FAQ categorie is toegevoegd!');
    }

    public function updateFaqCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = FaqCategory::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('admin.dashboard', ['tab' => 'faq'])
            ->with('success', 'FAQ categorie is bijgewerkt!');
    }

    public function deleteFaqCategory($id)
    {
        $category = FaqCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'faq'])
            ->with('success', 'FAQ categorie is verwijderd!');
    }

    // FAQ management
    public function storeFaq(Request $request)
    {
        $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::create([
            'faq_category_id' => $request->faq_category_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'order' => Faq::where('faq_category_id', $request->faq_category_id)->count(),
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'faq'])
            ->with('success', 'FAQ is toegevoegd!');
    }

    public function updateFaq(Request $request, $id)
    {
        $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update([
            'faq_category_id' => $request->faq_category_id,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'faq'])
            ->with('success', 'FAQ is bijgewerkt!');
    }

    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'faq'])
            ->with('success', 'FAQ is verwijderd!');
    }
}
