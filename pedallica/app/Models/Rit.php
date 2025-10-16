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
        'download_link',
        'gpx_file',
        'photo',
    ];

    protected $casts = [
        'date' => 'date',
        'distance' => 'integer',
    ];

    /**
     * Een rit behoort tot een ploeg
     */
    public function ploeg()
    {
        return $this->belongsTo(Ploeg::class);
    }
}
