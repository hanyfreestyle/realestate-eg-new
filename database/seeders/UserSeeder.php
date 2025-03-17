<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder {

    public function run(): void {

//        $oldUsers = DB::connection('secondary_db')->table('users')->get();
//        foreach ($oldUsers as $oldUser) {
//            $addUser = new User();
//            $addUser->name = $oldUser->name;
//            $addUser->email = $oldUser->email;
//            $addUser->password = $oldUser->password;
//            if ($oldUser->id == 1) {
//                $addUser->name = "Hany Darwish";
//                $addUser->email = "hany.freestyle4u@gmail.com";
//                $addUser->password = Hash::make("hany.freestyle4u@gmail.com");
//            }
//            $addUser->phone = $oldUser->phone;
//            $addUser->avatar_url = $oldUser->photo_thum_1;
//            $addUser->email_verified_at = $oldUser->created_at;
//            $addUser->created_at = $oldUser->created_at;
//            $addUser->updated_at = $oldUser->updated_at;
//            $addUser->deleted_at = $oldUser->deleted_at;
//            $addUser->is_active = $oldUser->status;
//            $addUser->save();
//            if ($oldUser->photo) {
//                Storage::disk('public')->delete($oldUser->photo);
//            }
//
//        }

        loadSeederFromFile('users', true);
        loadSeederFromFile('roles', true);
        loadSeederFromFile('permissions', true);
        loadSeederFromFile('model_has_permissions', true);
        loadSeederFromFile('model_has_roles', true);
        loadSeederFromFile('role_has_permissions', true);
        loadSeederFromFile('sessions', true);
        loadSeederFromFile('developers', true);
        loadSeederFromFile('developer_translations', true);
    }
}
