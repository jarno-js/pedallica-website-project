<?php

namespace App\View\Composers;

use App\Models\Sponsor;
use Illuminate\View\View;

class SponsorComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $sponsors = Sponsor::where('active', true)
            ->orderBy('order')
            ->get();

        $view->with('globalSponsors', $sponsors);
    }
}
