<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rits', function (Blueprint $table) {
            // Voeg route naam toe (hernoem title naar route_name voor duidelijkheid)
            $table->string('route_name')->nullable()->after('title');

            // Voeg start adres toe
            $table->string('start_address')->nullable()->after('location');

            // Voeg download link toe
            $table->string('download_link')->nullable()->after('start_address');

            // Voeg GPX file path toe
            $table->string('gpx_file')->nullable()->after('download_link');

            // Voeg foto toe
            $table->string('photo')->nullable()->after('gpx_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rits', function (Blueprint $table) {
            $table->dropColumn(['route_name', 'start_address', 'download_link', 'gpx_file', 'photo']);
        });
    }
};
