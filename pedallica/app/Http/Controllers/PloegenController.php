<?php

namespace App\Http\Controllers;

use App\Models\Ploeg;
use Illuminate\Http\Request;

class PloegenController extends Controller
{
    public function index()
    {
        return view('Ploegen');
    }

    public function show($slug)
    {
        $ploeg = Ploeg::where('slug', $slug)->firstOrFail();
        $ritten = $ploeg->ritten()->orderBy('date', 'desc')->get();

        return view('ploeg-detail', compact('ploeg', 'ritten'));
    }
}
