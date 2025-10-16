<?php

namespace Database\Seeders;

use App\Models\Ploeg;
use Illuminate\Database\Seeder;

class PloegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ploegen = [
            [
                'name' => 'Ploeg A',
                'slug' => 'ploeg-a',
                'description' => 'Snelle ploeg voor ervaren wielrenners',
                'is_evening_rides' => false,
            ],
            [
                'name' => 'Ploeg B',
                'slug' => 'ploeg-b',
                'description' => 'Gemiddeld tempo voor recreatieve renners',
                'is_evening_rides' => false,
            ],
            [
                'name' => 'Ploeg C',
                'slug' => 'ploeg-c',
                'description' => 'Rustig tempo voor beginners',
                'is_evening_rides' => false,
            ],
            [
                'name' => 'MTB',
                'slug' => 'mtb',
                'description' => 'Mountainbike ritten',
                'is_evening_rides' => false,
            ],
            [
                'name' => 'Avondritten',
                'slug' => 'avondritten',
                'description' => 'Speciale avondritten voor alle niveaus',
                'is_evening_rides' => true,
            ],
            [
                'name' => 'Pedallicava',
                'slug' => 'pedallicava',
                'description' => 'Pedallicava evenementen en ritten',
                'is_evening_rides' => false,
            ],
        ];

        foreach ($ploegen as $ploeg) {
            Ploeg::create($ploeg);
        }
    }
}
