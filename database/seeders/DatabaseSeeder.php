<?php

namespace Database\Seeders;

use Database\Seeders\RealEstate\AmenitySeeder;
use Database\Seeders\RealEstate\DeveloperSeeder;
use Database\Seeders\RealEstate\LocationSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call(UserSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(DeveloperSeeder::class);
        $this->call(AmenitySeeder::class);
        $this->call(LocationSeeder::class);
    }
}
