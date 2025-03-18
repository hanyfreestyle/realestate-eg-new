<?php

namespace App\Models\Admin\RealEstate;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Location extends Model {

    use Translatable;
    use SoftDeletes;
    use HasRecursiveRelationships;

    protected $table = "location";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'location_id';
    public array $translatedAttributes = ['name', 'des', 'g_des', 'g_title'];
    protected $fillable = ['parent_id', 'slug', 'projects_type', 'photo', 'photo_thumbnail', 'sort_order', 'latitude', 'longitude', 'is_active', 'is_searchable', 'is_home', 'projects_count', 'units_count', 'deleted_at'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function parent(): BelongsTo {
        return $this->belongsTo(Location::class,'parent_id','id');
    }
}
