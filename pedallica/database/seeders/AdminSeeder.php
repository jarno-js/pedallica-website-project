<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Maak de hoofd admin aan
        User::create([
            'first_name' => 'Pedallica',
            'last_name' => 'Admin',
            'email' => 'admin@pedallica.be',
            'password' => Hash::make('Pedalica1703!'),
            'birth_date' => '1970-01-01',
            'phone' => '0000000000',
            'street' => 'Admin',
            'house_number' => '1',
            'postal_code' => '0000',
            'city' => 'Admin',
            'country' => 'België',
            'approved' => true,
            'is_admin' => true,
        ]);

        // Maak Jarno Janssens admin
        $jarno = User::where('email', 'jarno.janssens0609@gmail.com')->first();
        if ($jarno) {
            $jarno->update(['is_admin' => true]);
        }
    }
}
