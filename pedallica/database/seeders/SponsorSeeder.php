<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'BATO',
                'description' => 'Korte beschrijving van de sponsor en wat ze doen.',
                'logo' => 'BATO.jpg',
                'website' => 'https://www.batobouw.be/',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'DATAPRINT',
                'description' => 'Korte beschrijving van de sponsor en wat ze doen.',
                'logo' => 'DATAPRINT.jpg',
                'website' => 'https://www.dataprint.be/',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'LOVINDI',
                'description' => 'Korte beschrijving van de sponsor en wat ze doen.',
                'logo' => 'LOVINDI.jpg',
                'website' => 'https://lovindi.odoo.com/',
                'order' => 3,
                'active' => true,
            ],
            [
                'name' => 'REV',
                'description' => 'Korte beschrijving van de sponsor en wat ze doen.',
                'logo' => 'REV.jpg',
                'website' => 'https://shop-rev.webshopapp.com/nl/',
                'order' => 4,
                'active' => true,
            ],
            [
                'name' => 'SEAL SOLUTIONS',
                'description' => 'Korte beschrijving van de sponsor en wat ze doen.',
                'logo' => 'SEAL SOLUTIONS.jpg',
                'website' => 'https://brandwerendonline.nl/',
                'order' => 5,
                'active' => true,
            ],
            [
                'name' => 'TVS',
                'description' => 'Korte beschrijving van de sponsor en wat ze doen.',
                'logo' => 'TVS.jpg',
                'website' => 'https://www.tuinenvanschepdael.be/',
                'order' => 6,
                'active' => true,
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
    }
}
