<?php

namespace App\Http\Controllers;

use App\Models\Ploeg;
use App\Models\Rit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request)
    {
        // Haal alle ploegen op in specifieke volgorde, ritten gesorteerd op datum (inclusief deelnemers voor aanwezigheid)
        $allePloegen = Ploeg::orderByRaw("FIELD(slug, 'pedallica-a', 'pedallica-b', 'pedallica-c', 'mtb', 'pedallicava', 'ploegen-rit')")
                            ->with(['ritten' => fn($q) => $q->orderBy('date')->with('users')])
                            ->get();

        // Aanwezigheidsstatus van de ingelogde gebruiker per rit
        $userRitStatuses = Auth::user()->ritten()->get()->pluck('pivot.status', 'id');

        // Splits in groepen voor weergave
        $ploegenVoorAvond = $allePloegen->whereIn('slug', ['pedallica-a', 'pedallica-b', 'pedallica-c', 'mtb']);
        $avondritten = null; // Avondritten bestaat niet meer als aparte ploeg
        $ploegenNaAvond = $allePloegen->whereIn('slug', ['pedallicava', 'ploegen-rit']);

        // Default subtab is eerste ploeg
        $subTab = $request->get('subtab', 'pedallica-a');

        $vandaag = Carbon::today();

        return view('dashboard', compact('subTab', 'allePloegen', 'ploegenVoorAvond', 'avondritten', 'ploegenNaAvond', 'vandaag', 'userRitStatuses'));
    }

    /**
     * Stel de aanwezigheidsstatus van de gebruiker in voor een rit.
     * status: 'aanwezig', 'twijfel', of null (= afwezig/verwijderen)
     */
    public function setAanwezigheid(Request $request, Rit $rit)
    {
        $status = $request->input('status') ?: null;

        if ($status !== null && !in_array($status, ['aanwezig', 'twijfel'])) {
            abort(422);
        }

        $user = Auth::user();

        // Verwijder bestaand record en voeg opnieuw in indien status opgegeven
        $user->ritten()->detach($rit->id);

        if ($status !== null) {
            $user->ritten()->attach($rit->id, ['status' => $status]);
        }

        $rit->load('users');
        $aantalAanwezig = $rit->users->filter(fn($u) => $u->pivot->status === 'aanwezig')->count();
        $aantalTwijfel  = $rit->users->filter(fn($u) => $u->pivot->status === 'twijfel')->count();

        return response()->json([
            'status'         => $status,
            'aantalAanwezig' => $aantalAanwezig,
            'aantalTwijfel'  => $aantalTwijfel,
        ]);
    }
}
