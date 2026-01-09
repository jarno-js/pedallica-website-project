<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'name' => 'Bato Bouw',
                'description' => 'Bouwbedrijf gespecialiseerd in renovaties en nieuwbouw',
                'logo' => 'uploads/sponsors/logos/BATO.jpg',
                'website' => 'https://www.batobouw.be/',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'R.EV',
                'description' => 'Specialist in elektrische fietsen en accessoires',
                'logo' => 'uploads/sponsors/logos/R.EV.jpg',
                'website' => 'https://shop-rev.webshopapp.com/nl/',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Lovindi',
                'description' => 'Premium fietskleding en accessoires',
                'logo' => 'uploads/sponsors/logos/LOVINDI.jpg',
                'website' => 'https://www.lovindi.be/',
                'order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Tuinen van Schepdael',
                'description' => 'Tuinaanleg en tuinonderhoud',
                'logo' => 'uploads/sponsors/logos/TUINEN VAN SCHEPDAAL.jpg',
                'website' => 'https://www.tuinenvanschepdael.be/',
                'order' => 4,
                'active' => true,
            ],
            [
                'name' => 'Dataprint',
                'description' => 'Drukkerij en print services',
                'logo' => 'uploads/sponsors/logos/DATAPRINT.jpg',
                'website' => 'https://www.dataprint.be/',
                'order' => 5,
                'active' => true,
            ],
            [
                'name' => 'Seal Solutions',
                'description' => 'Afdichtingen en technische oplossingen',
                'logo' => 'uploads/sponsors/logos/SEAL SOLUTIONS.jpg',
                'website' => 'https://www.companyweb.be/nl/0744981972/seal-solutions',
                'order' => 6,
                'active' => true,
            ],
        ];

        foreach ($sponsors as $sponsorData) {
            Sponsor::create($sponsorData);
        }
    }
}
