<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Blue\BlueUserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder {

    public function run(): void {


        if (File::isFile(base_path('database/seeders/Blue/BlueUserSeeder.php'))) {
            $this->call(BlueUserSeeder::class);
        }else{
            if (File::isFile(public_path('db/users.sql'))) {
                loadSeederFromFile('users');
            } else {
                User::factory()->create([
                    'name' => 'Hany Darwish',
                    'email' => 'admin@admin.com',
                    'is_active' => 1,
                ]);
            }
        }

        loadSeederFromFile('roles');
        loadSeederFromFile('permissions');
        loadSeederFromFile('model_has_permissions');
        loadSeederFromFile('model_has_roles');
        loadSeederFromFile('role_has_permissions');
        loadSeederFromFile('sessions');
    }
}
