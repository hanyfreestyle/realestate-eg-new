<?php

namespace App\Models\Admin\RealEstate;

use App\Traits\Admin\Query\TranslatableScopes;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model {
    use Translatable;
    use TranslatableScopes;
    use SoftDeletes;

    protected $table = "amenity";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'amenity_id';
    public array $translatedAttributes = ['name'];
    protected $fillable = ['icon', 'photo','is_active', 'deleted_at'];


}
