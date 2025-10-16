<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rit extends Model
{
    protected $fillable = [
        'ploeg_id',
        'title',
        'description',
        'date',
        'start_time',
        'location',
        'distance',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Een rit behoort tot een ploeg
     */
    public function ploeg()
    {
        return $this->belongsTo(Ploeg::class);
    }
}
