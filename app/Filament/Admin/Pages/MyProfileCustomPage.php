<?php

namespace App\Filament\Admin\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage;

class MyProfileCustomPage extends MyProfilePage {
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationGroup(): ?string {
        return __('filament/def.settings.NavigationGroup');
    }

}
