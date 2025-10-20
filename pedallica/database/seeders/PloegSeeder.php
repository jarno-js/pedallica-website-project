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
                'name' => 'Pedallica A',
                'slug' => 'pedallica-a',
                'description' => 'Snelle ploeg voor ervaren wielrenners',
                'is_evening_rides' => false,
            ],
            [
                'name' => 'Pedallica B',
                'slug' => 'pedallica-b',
                'description' => 'Gemiddeld tempo voor recreatieve renners',
                'is_evening_rides' => false,
            ],
            [
                'name' => 'Pedallica C',
                'slug' => 'pedallica-c',
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
                'name' => 'Pedallicava',
                'slug' => 'pedallicava',
                'description' => 'Pedallicava evenementen en ritten',
                'is_evening_rides' => false,
            ],
        ];

        foreach ($ploegen as $ploeg) {
            Ploeg::updateOrCreate(
                ['slug' => $ploeg['slug']],
                $ploeg
            );
        }
    }
}
