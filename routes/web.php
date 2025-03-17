<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

$adminRoutesPath = base_path('routes/Admin');
if (File::isDirectory($adminRoutesPath)) {
    foreach (File::allFiles($adminRoutesPath) as $file) {
        if ($file->getExtension() === 'php') {
            require $file->getRealPath();
        }
    }
}

Route::get('/', function () {
    return view('welcome');
});
