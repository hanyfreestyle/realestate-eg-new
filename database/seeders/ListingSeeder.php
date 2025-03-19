<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class ListingSeeder extends Seeder {

    public function run(): void {


        $columns = Schema::getColumnListing('listings'); // بيجيب الأعمدة من جدول target
        DB::table('listings')->insertUsing(
            $columns,
            DB::connection('secondary_db')->table('listings')->select($columns)
        );


        $columns = Schema::getColumnListing('listing_photos'); // بيجيب الأعمدة من جدول target
        DB::table('listing_photos')->insertUsing(
            $columns,
            DB::connection('secondary_db')->table('listing_photos')->select($columns)
        );

    }
}
