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
        // Verwijder bestaande sponsors
        Sponsor::truncate();

        $sponsors = [
            [
                'name' => 'R.EV',
                'logo' => 'uploads/sponsors/logos/Logo sponsors.png',
                'website' => 'https://shop-rev.webshopapp.com/nl/',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Dataprint',
                'logo' => 'uploads/sponsors/logos/Logo sponsors2 (1).png',
                'website' => 'https://www.dataprint.be/',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Bato Bouw',
                'logo' => 'uploads/sponsors/logos/Logo sponsors3.png',
                'website' => 'https://www.batobouw.be/',
                'order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Lovindi',
                'logo' => 'uploads/sponsors/logos/Logo sponsors4.png',
                'website' => 'https://www.lovindi.be/',
                'order' => 4,
                'active' => true,
            ],
            [
                'name' => 'Tuinen van Schepdael',
                'logo' => 'uploads/sponsors/logos/Logo sponsors5.png',
                'website' => 'https://www.tuinenvanschepdael.be/',
                'order' => 5,
                'active' => true,
            ],
        ];

        foreach ($sponsors as $sponsorData) {
            Sponsor::create($sponsorData);
        }
    }
}
