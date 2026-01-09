<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'faq_category_id',
        'question',
        'answer',
        'order',
    ];

    /**
     * Een FAQ behoort tot een categorie
     */
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }

    /**
     * Scope voor gesorteerde FAQs
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
