<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Toon de FAQ pagina voor bezoekers
     */
    public function index()
    {
        $categories = FaqCategory::with('faqs')->ordered()->get();

        return view('faq', compact('categories'));
    }
}
