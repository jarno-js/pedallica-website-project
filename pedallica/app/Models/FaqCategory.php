<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable = [
        'name',
        'order',
    ];

    /**
     * Een categorie heeft meerdere FAQs
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class)->orderBy('order');
    }

    /**
     * Scope voor gesorteerde categorieën
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
