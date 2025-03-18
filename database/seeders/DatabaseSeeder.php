<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call(UserSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(RealEstateDeveloperSeeder::class);
        $this->call(RealEstateAmenitySeeder::class);
        $this->call(RealEstateLocationSeeder::class);

    }
}
