<?php

namespace App\Models\Admin\RealEstate;

use Illuminate\Database\Eloquent\Model;

class DeveloperTranslation extends Model {
    protected $table = "developer_lang";
    protected $fillable = ['developer_id', 'locale', 'name', 'des', 'g_des', 'g_title'];
    public $timestamps = false;
}
