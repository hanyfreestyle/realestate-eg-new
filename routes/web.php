<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$adminRoutesPath = base_path('routes/Admin');
if (File::isDirectory($adminRoutesPath)) {
    foreach (File::allFiles($adminRoutesPath) as $file) {
        if ($file->getExtension() === 'php') {
            require $file->getRealPath();
        }
    }
}

Route::post('/ckeditor/upload', function(Request $request) {
    $file = $request->file('upload');
    $filename = time().'_'.Str::slug($file->getClientOriginalName());
    $path = $file->storeAs('uploads', $filename, 'public');

    return response()->json([
        'uploaded' => 1,
        'fileName' => $filename,
        'url' => asset("storage/$path")
    ]);
})->name('ckeditor.upload');

Route::get('/', function () {
    return view('welcome');
});
