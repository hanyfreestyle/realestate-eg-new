<?php

namespace App\Models\Admin\RealEstate;

use Illuminate\Database\Eloquent\Model;

class LocationTranslation extends Model {

    protected $table = "location_lang";
    protected $fillable = ['location_id', 'locale', 'name', 'des', 'g_des', 'g_title'];
    public $timestamps = false;

}
