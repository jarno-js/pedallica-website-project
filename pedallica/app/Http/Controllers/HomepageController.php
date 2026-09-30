<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Event;
use App\Models\Ploeg;
use Carbon\Carbon;

class HomepageController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::active()->ordered()->get();
        $events = Event::active()
            ->where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->take(9)
            ->get();
        $ploegen = Ploeg::with('ritten')
            ->where('slug', '!=', 'ploegen-rit')
            ->orderByRaw("FIELD(slug, 'pedallica-a', 'pedallica-b', 'pedallica-c', 'mtb', 'pedallicava')")
            ->get();
        return view('homepage', compact('sponsors', 'events', 'ploegen'));
    }
}
