<?php

namespace App\Models\Admin\RealEstate;


use App\Enums\RealEstate\EnumsRealEstateDatabaseTable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
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
    protected static function booted() {
        $CashKey = EnumsRealEstateDatabaseTable::DataLocationCash->value;
        static::saved(function ($model) use ($CashKey) {
            foreach (config('app.admin_lang') as $key => $value) {
                Cache::forget($CashKey . $key);
            }
        });
        static::deleted(function ($model) use ($CashKey){
            foreach (config('app.admin_lang') as $key => $value) {
                Cache::forget($CashKey . $key);
            }
        });
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function parent(): BelongsTo {
        return $this->belongsTo(Location::class,'parent_id','id');
    }
}
