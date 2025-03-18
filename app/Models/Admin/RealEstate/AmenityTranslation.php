<?php

namespace App\Models\Admin\RealEstate;

use Illuminate\Database\Eloquent\Model;

class AmenityTranslation extends Model {
    public $timestamps = false;
    protected $table = "amenity_lang";
    protected $fillable = ['amenity_id', 'locale', 'name'];

}
