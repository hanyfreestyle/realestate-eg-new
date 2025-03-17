<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

if (!function_exists('loadSeederFromFile')) {
    function loadSeederFromFile($name, $folderName = null) {
        if ($folderName == true){
            $folderName = config('appConfig.client_name')."/";
        }
        $tablePath = public_path('db/' . $folderName . $name . '.sql');
        if (File::isFile($tablePath)) {
            DB::unprepared(file_get_contents($tablePath));
        }
    }
}
if (!function_exists('loadSeederFromFileWithLang')) {
    function loadSeederFromFileWithLang($name, $folderName = null) {
        if ($folderName == true){
            $folderName = config('appConfig.client_name')."/";
        }
        $tablePath = public_path('db/' . $folderName . $name . '.sql');
        if (File::isFile($tablePath)) {
            DB::unprepared(file_get_contents($tablePath));
        }
        $tablePath = public_path('db/' . $folderName . $name . '_lang.sql');
        if (File::isFile($tablePath)) {
            DB::unprepared(file_get_contents($tablePath));
        }
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getFillableColumns')) {
    function getFillableColumns(string $table): array {
        // ✅ جلب جميع الأعمدة في الجدول
        $columns = Schema::getColumnListing($table);

        // ✅ استبعاد الحقول التي لا نريدها
        return array_values(array_diff($columns, ['id', 'created_at', 'updated_at']));
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getFillableColumnsAsText')) {
    function getFillableColumnsAsText(string $table): string {
        // ✅ جلب جميع الأعمدة من الجدول
        $columns = Schema::getColumnListing($table);

        // ✅ استبعاد الأعمدة غير المهمة
        $columns = array_diff($columns, ['id', 'created_at', 'updated_at']);

        // ✅ تحويل المصفوفة إلى `TEXT` بحيث تبدو كأنها كود PHP جاهز
        return "['" . implode("', '", $columns) . "'];";
    }
}




