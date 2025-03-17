<?php

namespace App\Models\Admin\Data;

use App\Enums\EnumsDatabaseTable;
use App\Traits\Admin\Query\TranslatableScopes;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class DataCountry extends Model {
    use Translatable;
    use TranslatableScopes;

    protected $table = "data_country";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $translationForeignKey = 'country_id';
    public array $translatedAttributes = ['name', 'g_title', 'g_des', 'slug', 'capital', 'currency', 'continent', 'nationality'];
    protected $fillable = ['iso2', 'iso3', 'fips', 'iso_numeric', 'flag', 'phone', 'symbol', 'currency_code', 'continent_code', 'language_codes', 'top_level_domain', 'time_zone', 'area_km', 'is_active', 'deleted_at'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected static function booted() {
        $CashKey = EnumsDatabaseTable::DataCountryCash->value;
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
    public function cities(): HasMany {
        return $this->hasMany(DataCity::class, 'city_id', 'id');
    }

}
