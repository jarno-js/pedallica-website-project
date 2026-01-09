<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categorie: Algemeen
        $algemeen = FaqCategory::create([
            'name' => 'Algemeen',
            'order' => 1,
        ]);

        Faq::create([
            'faq_category_id' => $algemeen->id,
            'question' => 'Wat is Pedallica?',
            'answer' => 'Pedallica is een enthousiaste fietsclub uit Berlare die regelmatig samen fietstochten organiseert. We hebben verschillende ploegen voor verschillende niveaus en interesses.',
            'order' => 1,
        ]);

        Faq::create([
            'faq_category_id' => $algemeen->id,
            'question' => 'Hoe kan ik lid worden?',
            'answer' => 'Je kan lid worden door je te registreren op onze website. Na registratie moet je account goedgekeurd worden door een admin voordat je kan inloggen.',
            'order' => 2,
        ]);

        // Categorie: Ritten
        $ritten = FaqCategory::create([
            'name' => 'Ritten & Evenementen',
            'order' => 2,
        ]);

        Faq::create([
            'faq_category_id' => $ritten->id,
            'question' => 'Wanneer rijden jullie?',
            'answer' => 'We organiseren regelmatig ritten, meestal in het weekend. Bekijk de evenementen pagina voor het volledige overzicht van onze aankomende ritten.',
            'order' => 1,
        ]);

        Faq::create([
            'faq_category_id' => $ritten->id,
            'question' => 'Welke ploegen zijn er?',
            'answer' => 'We hebben verschillende ploegen: Pedallica A, B en C voor wielrennen op verschillende snelheden, een MTB ploeg voor mountainbikers, en Pedallicava voor gravel ritten.',
            'order' => 2,
        ]);

        // Categorie: Praktisch
        $praktisch = FaqCategory::create([
            'name' => 'Praktisch',
            'order' => 3,
        ]);

        Faq::create([
            'faq_category_id' => $praktisch->id,
            'question' => 'Waar is het startpunt?',
            'answer' => 'De meeste ritten vertrekken vanuit Café In de Rustberg in Berlare. Het exacte vertrekpunt wordt altijd vermeld bij de rit informatie.',
            'order' => 1,
        ]);

        Faq::create([
            'faq_category_id' => $praktisch->id,
            'question' => 'Moet ik materiaal meebrengen?',
            'answer' => 'Breng je eigen fiets mee en een helm is verplicht. Ook een reserveband en gereedschap zijn aangeraden voor langere ritten.',
            'order' => 2,
        ]);
    }
}
