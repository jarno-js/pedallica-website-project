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
        $events = [
            [
                'title' => 'Kermis Koers 2021',
                'description' => 'Pedallica vzw stelt voor: Kermiskoers met drankenstand en activiteit t.v.v \'t Kompas. Kom langs en win een gesigneerd truitje van Remco.',
                'poster' => 'uploads/evenementen/posters/kermis-koers-7.jpg',
                'date' => '2021-09-18',
                'start_date' => '2021-09-18',
                'end_date' => '2021-09-18',
                'location' => 'Jaarmarkt Schepdaal',
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Kuiper Koers 2022',
                'description' => 'Pedallica vzw stelt voor: Kuiper Koers - #DEBELANGRIJKSTEKOERSVAN\'TJAAR. Inschrijven via rit op website. Start om 10 uur.',
                'poster' => 'uploads/evenementen/posters/kuiper-koers-8.jpg',
                'date' => '2022-09-10',
                'start_date' => '2022-09-10',
                'end_date' => '2022-09-10',
                'location' => 'Berlare',
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Kermis Koers 2022',
                'description' => 'Pedallica vzw stelt voor: Kermiskoers op de Jaarmarkt Schepdaal. Een stand waar wat te beleven valt! Kom langs en win een gesigneerd truitje van Remco. Initiatief ten voordele van MPC Sint-Franciscus De Hoeve.',
                'poster' => 'uploads/evenementen/posters/kermis-koers-9.jpg',
                'date' => '2022-09-17',
                'start_date' => '2022-09-17',
                'end_date' => '2022-09-17',
                'location' => 'Jaarmarkt Schepdaal',
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Jaarlijks Eetfestijn 2022',
                'description' => 'Pedallica vzw organiseert het jaarlijks eetfestijn vanaf 12 uur. Met dank aan onze hoofdsponsors: Bato, Seal Solutions, Dataprint, Lovindi, Tuinen Van Schepdaal en R.EV.',
                'poster' => 'uploads/evenementen/posters/spaghetti-en-croques-festijn-10.jpg',
                'date' => '2022-11-26',
                'start_date' => '2022-11-26',
                'end_date' => '2022-11-26',
                'location' => 'Feestzaal in de Rustberg, Scheestraat 129, 1703 Schepdaal',
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Spaghetti & Croques Festijn 2023',
                'description' => 'Pedallica vzw organiseert het Spaghetti & Croques Festijn vanaf 12 uur. Met dank aan onze hoofdsponsors: R.EV, Dataprint, Bato, Lovindi, Seal Solutions en Tuinen Van Schepdaal.',
                'poster' => 'uploads/evenementen/posters/spaghetti-croques-festijn-11.jpg',
                'date' => '2023-11-25',
                'start_date' => '2023-11-25',
                'end_date' => '2023-11-25',
                'location' => 'Feestzaal in de Rustberg, Scheestraat 129, 1703 Schepdaal',
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Spaghetti & Croques Festijn 2024',
                'description' => 'Pedallica vzw organiseert het Spaghetti & Croques Festijn! NIEUWE LOCATIE: Gildenhuis, E. Eylenboschstraat 20, 1703 Schepdaal. Start vanaf 12 uur. Liever gewoon saus bestellen? Mail voor 17 november naar pedallica@outlook.be. Met dank aan onze hoofdsponsors: R.EV, Dataprint, Bato, Lovindi, Seal Solutions en Tuinen Van Schepdaal.',
                'poster' => 'uploads/evenementen/posters/spaghetti-croques-festijn-12.jpg',
                'date' => '2024-11-23',
                'start_date' => '2024-11-23',
                'end_date' => '2024-11-23',
                'location' => 'Gildenhuis, E. Eylenboschstraat 20, 1703 Schepdaal',
                'is_passed' => true,
                'active' => true,
            ],
            [
                'title' => 'Spaghetti & Croques Festijn 2025',
                'description' => 'Pedallica vzw organiseert het Spaghetti & Croques Festijn! Gildenhuis, E. Eylenboschstraat 20, 1703 Schepdaal. Start vanaf 12 uur. Met dank aan onze hoofdsponsors: R.EV, Dataprint, Bato, Lovindi, Seal Solutions en Tuinen Van Schepdaal.',
                'poster' => 'uploads/evenementen/posters/spaghetti-croques-festijn.jpg',
                'date' => '2025-11-29',
                'start_date' => '2025-11-29',
                'end_date' => '2025-11-29',
                'location' => 'Gildenhuis, E. Eylenboschstraat 20, 1703 Schepdaal',
                'is_passed' => true,
                'active' => true,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
