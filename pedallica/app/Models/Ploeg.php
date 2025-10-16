<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ploeg extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_evening_rides',
    ];

    protected $casts = [
        'is_evening_rides' => 'boolean',
    ];

    /**
     * Een ploeg kan meerdere ritten hebben
     */
    public function ritten()
    {
        return $this->hasMany(Rit::class);
    }
}
