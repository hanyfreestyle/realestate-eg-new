<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class ListingLangSeeder extends Seeder {

    public function run(): void {

        $columns = Schema::getColumnListing('listing_translations'); // بيجيب الأعمدة من جدول target
        DB::table('listing_translations')->insertUsing(
            $columns,
            DB::connection('secondary_db')->table('listing_translations')->select($columns)
        );


    }
}
