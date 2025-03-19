<?php

namespace Database\Seeders\RealEstate;

use App\Models\Admin\RealEstate\Developer;
use App\Models\Admin\RealEstate\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class LocationSeeder extends Seeder {

    public function run(): void {


        $loadFormSours = false;

        if ($loadFormSours) {
            $oldData = DB::connection('secondary_db')->table('locations')->get();
            foreach ($oldData as $old) {
                $addData = new Location();
                $addData->id = $old->id;
                $addData->parent_id = $old->parent_id;
                $addData->slug = $old->slug;
                $addData->projects_type = $old->projects_type;
                $addData->photo = str_replace('storage/', '', $old->photo);
                $addData->photo_thumbnail = str_replace('storage/', '', $old->photo_thum_1);
                $addData->sort_order = $old->sort_order;
                $addData->latitude = $old->latitude;
                $addData->longitude = $old->longitude;
                $addData->is_active = $old->is_active;
                $addData->is_searchable = $old->is_searchable;
                $addData->is_home = $old->is_home;
                $addData->projects_count = $old->projects_count;
                $addData->units_count = $old->units_count;
                $addData->created_at = $old->created_at;
                $addData->updated_at = $old->updated_at;
                $addData->deleted_at = $old->deleted_at;
                $addData->save();
            }

            $columns = Schema::getColumnListing('location_lang'); // بيجيب الأعمدة من جدول target
            DB::table('location_lang')->insertUsing(
                $columns,
                DB::connection('secondary_db')->table('location_translations')->select($columns)
            );

        } else {
            loadSeederFromFile('location', true);
            loadSeederFromFile('location_lang', true);
        }

    }
}
