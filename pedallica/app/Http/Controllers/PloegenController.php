<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PloegenController extends Controller
{
    public function index()
    {
        return view('Ploegen');
    }
}
