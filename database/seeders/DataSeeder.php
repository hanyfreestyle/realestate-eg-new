<?php

namespace Database\Seeders;

use Database\Seeders\Data\DataAreaSeeder;
use Database\Seeders\Data\DataCitySeeder;
use Database\Seeders\Data\DataCountrySeeder;
use Database\Seeders\Data\DataVillageSeeder;
use Database\Seeders\DataConfig\DataConfigurationSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DataSeeder extends Seeder {

    public function run(): void {
        if (File::isFile(base_path('database/seeders/Data/DataCountrySeeder.php'))) {
            $this->call(DataCountrySeeder::class);
        }
        if (File::isFile(base_path('database/seeders/Data/DataCitySeeder.php'))) {
            $this->call(DataCitySeeder::class);
        }
        if (File::isFile(base_path('database/seeders/Data/DataAreaSeeder.php'))) {
            $this->call(DataAreaSeeder::class);
        }
        if (File::isFile(base_path('database/seeders/Data/DataVillageSeeder.php'))) {
            $this->call(DataVillageSeeder::class);
        }
        if (File::isFile(base_path('database/seeders/DataConfig/DataConfigurationSeeder.php'))) {
            $this->call(DataConfigurationSeeder::class);
        }

    }
}
