<?php

namespace App\Filament\Admin\Resources\Data\DataCountryResource\Pages;


use App\Filament\Admin\Resources\Data\DataCountryResource;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataCountry extends ViewRecord {
    use ViewTranslatable;

    protected static string $resource = DataCountryResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\EditAction::make(),
        ];
    }
}
