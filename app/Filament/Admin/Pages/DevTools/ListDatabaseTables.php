<?php

namespace App\Filament\Admin\Pages\DevTools;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ListDatabaseTables extends Page {


    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static string $view = 'filament.pages.admin.dev-tools.list-database-tables';
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
        return __('filament/core/fileList.listDb.NavigationLabel');
    }

    public function getTitle(): string|Htmlable {
        return __('filament/core/fileList.listDb.Title');
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
        $existingTables = array_map(fn($table) => $table->TABLE_NAME, $allTables);
        return $existingTables;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // ✅ جلب الجداول المحددة فقط
    public function getTables(): array {
        return $this->getAvailableTables();
    }


}
