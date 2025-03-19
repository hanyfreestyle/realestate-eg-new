<?php

namespace App\Models\Admin\RealEstate;

use App\Enums\RealEstate\EnumsRealEstateDatabaseTable;
use App\Traits\Admin\Query\TranslatableScopes;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Amenity extends Model {
    use Translatable;
    use TranslatableScopes;
    use SoftDeletes;

    protected $table = "amenity";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'amenity_id';
    public array $translatedAttributes = ['name'];
    protected $fillable = ['icon', 'photo','is_active', 'deleted_at'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected static function booted() {
        $CashKey = EnumsRealEstateDatabaseTable::DataAmenitiesCash->value;
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

}
