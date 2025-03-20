<?php

namespace App\Models\Admin\RealEstate;

use App\Enums\RealEstate\EnumsRealEstateDatabaseTable;
use App\Traits\Admin\Query\TranslatableScopes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Listing extends Model {
    use SoftDeletes;
    use Translatable;
    use TranslatableScopes;

    protected $table = "listings";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'listing_id';
    public array $translatedAttributes = ['name', 'des', 'g_title', 'g_des'];
    protected $fillable = ['listing_type', 'parent_id', 'location_id', 'developer_id', 'slug', 'slider_images_dir', 'slider_active', 'photo', 'photo_thum_1', 'youtube_url', 'price', 'area', 'baths', 'rooms', 'unit_status', 'status', 'project_type', 'units_count', 'property_type', 'view', 'latitude', 'longitude', 'delivery_date', 'is_published', 'is_featured', 'published_at', 'amenity', 'deleted_at'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected static function booted() {
        $CashKey = EnumsRealEstateDatabaseTable::DataProjectsCash->value;

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
    protected function amenity(): Attribute {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value)
        );
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scopeProjects($query) {
        return $query->where('listing_type', 'Project');
    }

    public function scopeUnits($query) {
        return $query->where('listing_type', 'Unit');
    }

    public function scopeForSale($query) {
        return $query->where('listing_type', 'ForSale');
    }

    public function units() {
        return $this->hasMany(Listing::class, 'parent_id')->where('listing_type', 'Unit');
    }

    public function project() {
        return $this->belongsTo(Listing::class, 'parent_id')->where('listing_type', 'Project');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function location() {
        return $this->belongsTo(Location::class);
    }
    public function developer() {
        return $this->belongsTo(Developer::class);
    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # Relations Web
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//    public function web_units(): HasMany {
//        return $this->hasMany(Listing::class, 'parent_id', 'id')
//            ->where('is_published', true)
//            ->with('translation');
//    }
//
//    public function slider(): HasMany {
//        return $this->hasMany(ListingPhoto::class, 'listing_id', 'id')->orderBy('position');
//    }
//
//    public function faqs(): HasMany {
//        return $this->hasMany(Question::class, 'project_id', 'id')->with('translation');
//    }
//
//    public function pro_units(): HasMany {
//        return $this->hasMany(Listing::class, 'parent_id', 'id')->with('translation');
//    }
//
//
//    public function scopeWebProjects(Builder $query): Builder {
//        return $query->where('is_published', true)
//            ->where('listing_type', 'Project')
//            ->translatedIn()
//            ->with('locationName')
//            ->with('developerName');
//    }
//
//    public function scopeWebUnits(Builder $query): Builder {
//        return $query->where('is_published', true)
//            ->where('listing_type', '!=', 'Project')
//            ->translatedIn()
//            ->with('locationName')
//            ->with('projectName')
//            ->with('developerName');
//    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # Scope Web
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//    public function scopeDef(Builder $query): Builder {
//        return $query->where('is_published', true)
//            ->translatedIn()
//            ->with('locationName')
//            ->with('translations');
//    }
//
//    public function scopeProject(Builder $query): Builder {
//        return $query->where('listing_type', 'Project');
//    }
//
//    public function scopeUnit(Builder $query): Builder {
//        return $query->where('listing_type', 'Unit');
//    }
//
//    public function scopeForSale(Builder $query): Builder {
//        return $query->where('listing_type', 'ForSale');
//    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Scope Admin
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

//    public function scopeProjectAdmin(Builder $query): Builder {
//        return $query->where('listing_type', 'Project')
//            ->with('translations')
//            ->withCount('admin_more_photos')
//            ->withCount('admin_units')
//            ->withCount('admin_faqs');
//    }
//
//    public function scopeUnitsAdmin(Builder $query): Builder {
//        return $query->where('listing_type', 'Unit')
//            ->with('translations')
//            ->withCount('admin_more_photos');
//
//    }
//
//    public function scopeForSaleAdmin(Builder $query): Builder {
//        return $query->where('listing_type', 'ForSale')
//            ->withCount('admin_more_photos')
//            ->with('translations');
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # Admin Relations
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//    public function admin_units(): HasMany {
//        return $this->hasMany(Listing::class, 'parent_id', 'id');
//    }
//
//    public function admin_more_photos(): HasMany {
//        return $this->hasMany(ListingPhoto::class, 'listing_id', 'id');
//    }
//
//    public function admin_faqs(): HasMany {
//        return $this->hasMany(Question::class, 'project_id', 'id');
//    }
//
//    public function listingsMenu(): HasMany {
//        return $this->hasMany(Listing::class, 'parent_id', 'id')->select(['id','parent_id','property_type']);
//    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # Main Relations
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//
//    public function developerName(): BelongsTo {
//        return $this->belongsTo(Developer::class, 'developer_id', 'id')->with('translation');
//    }
//
//    public function locationName(): BelongsTo {
//        return $this->belongsTo(Location::class, 'location_id', 'id')->with('translation');
//    }
//
//    public function projectName(): BelongsTo {
//        return $this->belongsTo(Listing::class, 'parent_id', 'id');
//    }
//
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//
//    public function del_units(): HasMany {
//        return $this->hasMany(Listing::class, 'parent_id')->withTrashed();
//    }
//
//    public function del_pages(): HasMany {
//        return $this->hasMany(Page::class, 'compound_id')->withTrashed();
//    }
//
//    public function del_posts(): HasMany {
//        return $this->hasMany(Post::class, 'listing_id')->withTrashed();
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function scopeCashCompoundList(Builder $query): array|\Illuminate\Database\Eloquent\Collection {
//        return $query->select('id')->with(['translations' => function ($query) {
//            $query->select('listing_id', 'locale', 'name');
//        }])->get();
//    }

}
