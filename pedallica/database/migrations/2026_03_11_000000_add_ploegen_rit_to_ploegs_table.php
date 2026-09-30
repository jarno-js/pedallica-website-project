<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('ploegs')->insertOrIgnore([
            'name'             => 'Ploegen Rit',
            'slug'             => 'ploegen-rit',
            'description'      => 'Rit waarbij alle ploegen samen rijden',
            'is_evening_rides' => false,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('ploegs')->where('slug', 'ploegen-rit')->delete();
    }
};
