<?php

namespace App\Filament\Admin\Resources\RealEstate\DeveloperResource\Pages;

use App\Filament\Admin\Resources\RealEstate\DeveloperResource;
use Filament\Actions;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;

class ViewDeveloper extends ViewRecord{
    use ViewTranslatable;
    protected static string $resource = DeveloperResource::class;

    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }
}
