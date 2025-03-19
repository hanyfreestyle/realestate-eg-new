<?php

namespace App\Models\Admin\RealEstate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingTranslation extends Model {

    protected $table = "listing_translations";
    protected $fillable = ['listing_id', 'locale', 'name', 'des', 'g_des', 'g_title'];
    public $timestamps = false;
}
