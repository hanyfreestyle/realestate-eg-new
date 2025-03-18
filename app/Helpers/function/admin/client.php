<?php

use Illuminate\Support\Facades\File;


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getbrandLogo')) {
    function getbrandLogo(): string {
        $defLogo = asset('assets/client/_def/logo.png');
        $folderName = config('appConfig.client_name');

        if ($folderName) {
            $filePath = public_path("assets/client/{$folderName}/logo.png");
            if (File::isFile($filePath)) {
                return asset("assets/client/{$folderName}/logo.png");
            }
        }
        return $defLogo;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getFavIcon')) {
    function getFavIcon(): string {
        $defFav = asset('assets/client/_def/fav.png');
        $folderName = config('appConfig.client_name');
        if ($folderName) {
            $filePath = public_path("assets/client/{$folderName}/logo.png");
            if (File::isFile($filePath)) {
                return asset("assets/client/{$folderName}/fav.png");
            }
        }
        return $defFav;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getBackgroundsDirectory')) {
    function getBackgroundsDirectory(): string {
        $default = 'images/filament/backgrounds/triangles';

        $folderName = config('appConfig.client_name');

        if ($folderName) {
            $relativePath = "assets/client/{$folderName}/backgrounds";
            $absolutePath = public_path($relativePath);

            if (File::isDirectory($absolutePath)) {
                return $relativePath;
            }
        }

        return $default;
    }
}




