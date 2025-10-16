<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EvenementenController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::active()->upcoming()->orderBy('start_date', 'asc')->get();
        $passedEvents = Event::active()->passed()->orderBy('start_date', 'desc')->get();

        return view('Evenementen', compact('upcomingEvents', 'passedEvents'));
    }
}
