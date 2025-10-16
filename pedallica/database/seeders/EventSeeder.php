<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Spaghetti & Croques Festijn',
                'poster' => 'eetfestijn23-11-24.jpg',
                'start_date' => Carbon::create(2024, 11, 23),
                'end_date' => Carbon::create(2024, 11, 23),
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Spaghetti & Croques Festijn',
                'poster' => 'eetfestijn25-11-23.jpg',
                'start_date' => Carbon::create(2023, 11, 25),
                'end_date' => Carbon::create(2023, 11, 25),
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Jaarlijks Eetfestijn',
                'poster' => 'eetfestijn26-11-22.jpg',
                'start_date' => Carbon::create(2022, 11, 26),
                'end_date' => Carbon::create(2022, 11, 26),
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Kermiskoers',
                'poster' => 'kermiskoers17-09-22.jpg',
                'start_date' => Carbon::create(2022, 9, 17),
                'end_date' => Carbon::create(2022, 9, 17),
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Kuiper Koers',
                'poster' => 'kuiperkoers10-09-22.jpg',
                'start_date' => Carbon::create(2022, 9, 10),
                'end_date' => Carbon::create(2022, 9, 10),
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Kermiskoers',
                'poster' => 'kermiskoers18-09-21.jpg',
                'start_date' => Carbon::create(2021, 9, 18),
                'end_date' => Carbon::create(2021, 9, 18),
                'is_passed' => true,
                'active' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
