<?php

namespace App\Models\Admin\RealEstate;

use App\Traits\Admin\Query\TranslatableScopes;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model {
    use Translatable;
    use TranslatableScopes;
    use SoftDeletes;

    protected $table = "developers";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'developer_id';
    public array $translatedAttributes = ['name', 'des', 'g_title', 'g_des'];
    protected $fillable = ['slug', 'photo', 'photo_thum_1', 'is_active', 'deleted_at'];


}
