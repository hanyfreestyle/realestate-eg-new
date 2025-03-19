<?php

namespace Database\Seeders\RealEstate;

use App\Models\Admin\RealEstate\Developer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class DeveloperSeeder extends Seeder {

    public function run(): void {


        $loadFormSours = false;

        if ($loadFormSours) {
            $oldData = DB::connection('secondary_db')->table('developers')->get();
            foreach ($oldData as $old) {
                $addData = new Developer();
                $addData->id = $old->id;
                $addData->slug = $old->slug;
                $addData->photo = str_replace('storage/', '', $old->photo);
                $addData->photo_thumbnail = str_replace('storage/', '', $old->photo_thum_1);
                $addData->created_at = $old->created_at;
                $addData->updated_at = $old->updated_at;
                $addData->deleted_at = $old->deleted_at;
                $addData->save();
            }

            $columns = Schema::getColumnListing('developer_lang'); // بيجيب الأعمدة من جدول target

            DB::table('developer_lang')->insertUsing(
                $columns,
                DB::connection('secondary_db')->table('developer_translations')->select($columns)
            );
        } else {
            loadSeederFromFile('developer', true);
            loadSeederFromFile('developer_lang', true);
        }

    }
}
