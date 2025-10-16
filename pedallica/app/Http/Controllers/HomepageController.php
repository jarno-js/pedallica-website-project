<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    // app/Http/Controllers/HomepageController.php
    public function index()
    {
        return view('Homepage'); // of 'homepage' als je bestanden lowercase noemt
    }
}
