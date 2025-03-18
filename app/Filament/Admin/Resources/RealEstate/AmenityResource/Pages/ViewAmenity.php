<?php

namespace App\Filament\Admin\Resources\RealEstate\AmenityResource\Pages;

use App\Filament\Admin\Resources\RealEstate\AmenityResource;
use Filament\Actions;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;

class ViewAmenity extends ViewRecord{
    use ViewTranslatable;
    protected static string $resource = AmenityResource::class;

    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }
}
