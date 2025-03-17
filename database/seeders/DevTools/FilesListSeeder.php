<?php

namespace Database\Seeders\DevTools;


use Illuminate\Database\Seeder;

class FilesListSeeder extends Seeder {

    public function run(): void {
        if (!config('appConfig.load_from_remote_db')) {
            loadSeederFromFile('admin_files_lists_group');
            loadSeederFromFile('admin_files_lists');
        }
    }
}
