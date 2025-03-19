<?php

namespace Database\Seeders\RealEstate;


use App\Models\Admin\RealEstate\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class AmenitySeeder extends Seeder {

    public function run(): void {
        $loadFormSours = false;

        if ($loadFormSours) {
            $oldData = DB::connection('secondary_db')->table('amenities')->get();
            foreach ($oldData as $old) {
                $addData = new Amenity();
                $addData->id = $old->id;
                $addData->icon = $old->icon;
                $addData->photo = str_replace('storage/', '', $old->photo);
                $addData->created_at = $old->created_at;
                $addData->updated_at = $old->updated_at;
                $addData->deleted_at = $old->deleted_at;
                $addData->save();
            }

            $columns = Schema::getColumnListing('amenity_lang'); // بيجيب الأعمدة من جدول target

            DB::table('amenity_lang')->insertUsing(
                $columns,
                DB::connection('secondary_db')->table('amenity_translations')->select($columns)
            );
        } else {
            loadSeederFromFile('amenity', true);
            loadSeederFromFile('amenity_lang', true);
        }

    }
}
