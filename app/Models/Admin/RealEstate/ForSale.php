<?php

namespace App\Models\Admin\RealEstate;

use Astrotomic\Translatable\Translatable;

class ForSale extends Listing {
    use Translatable;
    public $translationModel =  ListingTranslation::class;

    protected static function booted() {
        static::addGlobalScope('forSale', function ($query) {
            $query->where('listing_type', 'ForSale');
        });
    }
}
