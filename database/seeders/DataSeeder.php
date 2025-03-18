<?php

namespace Database\Seeders;

use Database\Seeders\Data\DataCountrySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DataSeeder extends Seeder {

    public function run(): void {
        if (File::isFile(base_path('database/seeders/Data/DataCountrySeeder.php'))) {
            $this->call(DataCountrySeeder::class);
        }


    }
}
