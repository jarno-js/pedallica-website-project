<?php

namespace App\Http\Controllers;

use App\Models\Ploeg;
use App\Models\User;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request)
    {
        // Haal alle ploegen op in specifieke volgorde
        $allePloegen = Ploeg::orderByRaw("FIELD(slug, 'ploeg-a', 'ploeg-b', 'ploeg-c', 'mtb', 'avondritten', 'pedallicava')")
                            ->get();

        // Splits in groepen voor weergave
        $ploegenVoorAvond = $allePloegen->whereIn('slug', ['ploeg-a', 'ploeg-b', 'ploeg-c', 'mtb']);
        $avondritten = $allePloegen->where('slug', 'avondritten')->first();
        $ploegenNaAvond = $allePloegen->where('slug', 'pedallicava');

        // Default tab is 'ritten'
        $tab = $request->get('tab', 'ritten');
        $subTab = $request->get('subtab', 'ploeg-a');

        // Haal alle leden op (goedgekeurde gebruikers)
        $leden = User::where('approved', true)->orderBy('first_name')->get();

        // Haal gepubliceerd nieuws op
        $nieuws = News::where('published', true)
                      ->orderBy('published_at', 'desc')
                      ->with('author')
                      ->get();

        return view('dashboard', compact('tab', 'subTab', 'allePloegen', 'ploegenVoorAvond', 'avondritten', 'ploegenNaAvond', 'leden', 'nieuws'));
    }
}
