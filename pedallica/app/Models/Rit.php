<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rit extends Model
{
    protected $fillable = [
        'ploeg_id',
        'title',
        'route_name',
        'description',
        'date',
        'start_time',
        'location',
        'start_address',
        'distance',
        'elevation_gain',
        'download_link',
        'gpx_file',
        'photo',
    ];

    protected $casts = [
        'date' => 'date',
        'distance' => 'integer',
        'elevation_gain' => 'integer',
    ];

    /**
     * Een rit behoort tot een ploeg
     */
    public function ploeg()
    {
        return $this->belongsTo(Ploeg::class);
    }

    /**
     * Een rit kan meerdere deelnemers (users) hebben
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
