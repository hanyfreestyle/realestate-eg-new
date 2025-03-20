<?php

namespace App\Models\Admin\RealEstate;

use Astrotomic\Translatable\Translatable;

class Projects extends Listing {
    use Translatable;
    public $translationModel =  ListingTranslation::class;

    protected static function booted() {
        static::addGlobalScope('projects', function ($query) {
            $query->where('listing_type', 'Project');
        });
    }
}
