<?php

namespace Database\Seeders;

use Database\Seeders\Blue\CustomerSeeder;
use Database\Seeders\Blue\InventorySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BlueRockSeeder extends Seeder {

    public function run(): void {
        if (File::isFile(base_path('database/seeders/Blue/CustomerSeeder.php'))) {
            $this->call(CustomerSeeder::class);
        }
        if (File::isFile(base_path('database/seeders/Blue/InventorySeeder.php'))) {
            $this->call(InventorySeeder::class);
        }
    }
}
