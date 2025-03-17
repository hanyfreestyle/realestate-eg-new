<?php

namespace Database\Seeders;

use Database\Seeders\Quiz\QuizDataSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call(UserSeeder::class);
//        $this->call(DevToolsSeeder::class);
        $this->call(DataSeeder::class);
//        $this->call(BlueRockSeeder::class);
//        $this->call(QuizDataSeeder::class);
        if (File::isFile(base_path('database/seeders/SchoolDirSeeder.php'))) {
            $this->call(SchoolDirSeeder::class);
        }
    }
}
