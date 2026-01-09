@extends('layouts.app')

@section('title', 'Veelgestelde Vragen - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Veelgestelde Vragen</h1>
            <p class="text-lg text-gray-600">Vind snel antwoorden op je vragen over Pedallica</p>
        </div>

        @if($categories->count() > 0)
            <!-- FAQ Categorieën -->
            <div class="space-y-8">
                @foreach($categories as $category)
                    @if($category->faqs->count() > 0)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <!-- Categorie Header -->
                            <div class="bg-orange-500 px-6 py-4">
                                <h2 class="text-2xl font-bold text-white">{{ $category->name }}</h2>
                            </div>

                            <!-- FAQs in deze categorie -->
                            <div class="divide-y divide-gray-200">
                                @foreach($category->faqs as $faq)
                                    <div class="p-6">
                                        <!-- Vraag -->
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-start">
                                            <svg class="w-6 h-6 text-orange-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                                            {{ $faq->question }}
                                        </h3>

                                        <!-- Antwoord -->
                                        <div class="ml-8 text-gray-700 leading-relaxed">
                                            {!! nl2br(e($faq->answer)) !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <!-- Geen FAQs beschikbaar -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nog geen veelgestelde vragen</h3>
                <p class="text-gray-600">We werken eraan om je zo snel mogelijk van antwoorden te voorzien!</p>
            </div>
        @endif

        <!-- Contact CTA -->
        <div class="mt-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-8 text-center text-white">
            <h3 class="text-2xl font-bold mb-3">Staat je vraag er niet bij?</h3>
            <p class="text-lg mb-6 opacity-90">Neem gerust contact met ons op, we helpen je graag verder!</p>
            <a href="mailto:pedallica@outlook.be" class="inline-block bg-white text-orange-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition-colors shadow-md">
                Stuur ons een email
            </a>
        </div>
    </div>
</div>
@endsection
