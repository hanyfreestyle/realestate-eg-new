<?php

namespace App\Models\Admin\Data;

use Illuminate\Database\Eloquent\Model;

class DataCountryTranslation extends Model {
    protected $table = "data_country_translations";
    public $timestamps = false;
    protected $fillable = ['country_id', 'locale', 'name', 'g_title', 'g_des', 'slug', 'capital', 'currency', 'continent', 'nationality'];

}
