<?php

namespace App\Filament\Admin\Pages\DevTools;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ExportDatabase extends Page {


    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static string $view = 'filament.pages.admin.dev-tools.export-database';
    protected static ?int $navigationSort = 2;
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function canAccess(): bool {
        return Gate::allows('view', static::class); // ✅ استخدام Gate للتحقق من إذن الوصول
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getNavigationGroup(): ?string {
        return __('filament/core/fileList.navigation_group');
    }

    public static function getNavigationLabel(): string {
        return __('filament/core/fileList.exportDb.NavigationLabel');
    }

    public function getTitle(): string|Htmlable {
        return __('filament/core/fileList.exportDb.Title');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function allowedTables(): array {

        $tablesName = [
            'admin_files_lists', 'admin_files_lists_group',
            'users', 'roles', 'permissions', 'model_has_permissions', 'model_has_roles', 'role_has_permissions', 'breezy_sessions', 'sessions'
        ];

        $clientArr = self::getClientTable();
        return array_merge_recursive($clientArr, $tablesName);


    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // ✅ جلب الجداول الموجودة حاليًا في قاعدة البيانات
    public function getAvailableTables(): array {
        // جلب جميع الجداول من قاعدة البيانات
        $databaseName = config('database.connections.mysql.database');
        $allTables = DB::select("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = ?", [$databaseName]);

        // تحويل نتيجة الاستعلام إلى مصفوفة أسماء الجداول
        $existingTables = array_map(fn($table) => $table->TABLE_NAME, $allTables);
        $allowedTables = $this->allowedTables();
        // تصفية الجداول بحيث تبقى فقط الجداول المسموح بها والتي توجد في قاعدة البيانات
        return array_values(array_intersect($allowedTables, $existingTables));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // ✅ جلب الجداول المحددة فقط
    public function getTables(): array {
        return $this->getAvailableTables();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||`
    // تصدير بيانات الجدول المحدد
    public function exportSelectedTables(array $selectedTables): void {
        $folderName = config('appConfig.client_name');
        if ($folderName != null) {
            $exportPath = public_path('db/' . $folderName);
        } else {
            $exportPath = public_path('db');
        }
        // ✅ إنشاء المجلد إذا لم يكن موجودًا
        if (!File::exists($exportPath)) {
            File::makeDirectory($exportPath, 0755, true);
        }

        foreach ($selectedTables as $table) {
            $data = DB::table($table)->get();

            // ✅ إعداد نص SQL الأساسي
            $sql = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
            $sql .= "START TRANSACTION;\n";
            $sql .= "SET time_zone = \"+00:00\";\n\n";

            if ($data->isNotEmpty()) {
                // ✅ إذا كان الجدول يحتوي على بيانات، إضافة INSERT INTO
                $columns = array_keys((array)$data->first());

                $sql .= "INSERT INTO `$table` (`" . implode('`, `', $columns) . "`) VALUES\n";

                $values = [];
                foreach ($data as $row) {
                    $rowData = array_map(function ($value) {
                        return is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                    }, (array)$row);
                    $values[] = "(" . implode(', ', $rowData) . ")";
                }

                $sql .= implode(",\n", $values) . ";\n";
            }

            // ✅ إنهاء الملف بعملية COMMIT
            $sql .= "COMMIT;\n";

            file_put_contents("$exportPath/{$table}.sql", str_replace("\r\n", "\n", $sql));
        }

        session()->flash('success', 'تم تصدير الجداول المحددة بنجاح إلى مجلد db.');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getClientTable() {
        $folderName = config('appConfig.client_name');
        $clientArr = [];
        if ($folderName == 'quiz') {
            $clientArr = [
                'app_data_class', 'app_data_class_lang', 'app_data_subject', 'app_data_subject_lang', 'app_data_section',
                'app_data_section_lang', 'app_data_term', 'app_data_term_lang', 'app_data_unit', 'app_data_unit_lang',
                'app_data_revision', 'app_data_revision_lang',
            ];
        }
        if ($folderName == 'SchoolDir') {
            $clientArr = [
                'data_gender', 'data_gender_lang', 'data_school_halkat', 'data_school_halkat_lang', 'data_school_hour', 'data_school_hour_lang',
                'data_school_type', 'data_school_type_lang', 'data_village', 'data_village_translations',
                'dir_school', 'dir_school_contact', 'dir_school_google', 'dir_school_google_response', 'dir_school_lang',
                'dir_stage', 'dir_stage_lang', 'dir_stage_pivot',
            ];
        }
        return $clientArr;
    }

}
