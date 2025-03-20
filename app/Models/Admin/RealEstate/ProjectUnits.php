<?php

namespace App\Models\Admin\RealEstate;

use Astrotomic\Translatable\Translatable;

class ProjectUnits extends Listing {
    use Translatable;
    public $translationModel =  ListingTranslation::class;

    protected static function booted() {
        static::addGlobalScope('units', function ($query) {
            $query->where('listing_type', 'Units');
        });
    }
}
