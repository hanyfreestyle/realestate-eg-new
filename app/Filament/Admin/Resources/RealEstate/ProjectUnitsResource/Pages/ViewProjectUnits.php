<?php

namespace App\Filament\Admin\Resources\RealEstate\ProjectUnitsResource\Pages;

use App\Filament\Admin\Resources\RealEstate\ProjectUnitsResource;
use Filament\Actions;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;

class ViewProjectUnits extends ViewRecord{
    use ViewTranslatable;
    protected static string $resource = ProjectUnitsResource::class;

    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }
}
