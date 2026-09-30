<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verwijder bestaande events
        Event::truncate();

        $events = [
            [
                'title' => 'Openingsrit',
                'description' => 'seizoen pedallica',
                'date' => '2026-03-01',
                'start_date' => '2026-03-01',
                'end_date' => '2026-03-01',
                'is_passed' => false,
                'active' => true,
            ],
            [
                'title' => 'Quiz',
                'description' => 'pedallica / JK JOS',
                'date' => '2026-03-21',
                'start_date' => '2026-03-21',
                'end_date' => '2026-03-21',
                'is_passed' => false,
                'active' => true,
            ],
            [
                'title' => 'Paasrit',
                'description' => 'gezinsrit',
                'date' => '2026-04-05',
                'start_date' => '2026-04-05',
                'end_date' => '2026-04-05',
                'is_passed' => false,
                'active' => true,
            ],
            [
                'title' => 'Avondmarkt Schepdaal',
                'description' => 'Jeneverstand',
                'date' => '2026-05-08',
                'start_date' => '2026-05-08',
                'end_date' => '2026-05-08',
                'is_passed' => false,
                'active' => true,
            ],
            [
                'title' => 'Weekend Pedallica',
                'description' => '28-30 mei',
                'date' => '2026-05-28',
                'start_date' => '2026-05-28',
                'end_date' => '2026-05-30',
                'is_passed' => false,
                'active' => true,
            ],
            [
                'title' => 'Kuiperkoers',
                'description' => 'sluiting Clublokaal',
                'date' => '2026-06-20',
                'start_date' => '2026-06-20',
                'end_date' => '2026-06-20',
                'is_passed' => false,
                'active' => true,
            ],
            [
                'title' => '3-daagse Luxemburg',
                'description' => '27-29 juli',
                'date' => '2026-07-27',
                'start_date' => '2026-07-27',
                'end_date' => '2026-07-29',
                'is_passed' => false,
                'active' => true,
            ],
            [
                'title' => 'Spaghetti & Croques',
                'description' => 'eetfestijn',
                'date' => '2026-11-28',
                'start_date' => '2026-11-28',
                'end_date' => '2026-11-28',
                'is_passed' => false,
                'active' => true,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
