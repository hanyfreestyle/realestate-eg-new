<?php

namespace App\Filament\Admin\Resources\RealEstate\LocationResource\Pages;

use App\Filament\Admin\Resources\RealEstate\LocationResource;
use Filament\Actions;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;

class ViewLocation extends ViewRecord{
    use ViewTranslatable;
    protected static string $resource = LocationResource::class;

    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }
}
