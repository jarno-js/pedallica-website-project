<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'title',
        'poster',
        'start_date',
        'end_date',
        'is_passed',
        'active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_passed' => 'boolean',
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('is_passed', false);
    }

    public function scopePassed($query)
    {
        return $query->where('is_passed', true);
    }

    public function scopeOrderedByDate($query)
    {
        return $query->orderBy('start_date', 'asc');
    }

    // Helper method to check if event has passed
    public function checkIfPassed()
    {
        $this->is_passed = $this->end_date->lt(Carbon::today());
        $this->save();
    }
}
