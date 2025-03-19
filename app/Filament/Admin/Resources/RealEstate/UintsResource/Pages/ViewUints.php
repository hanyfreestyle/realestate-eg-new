<?php

namespace App\Filament\Admin\Resources\RealEstate\UintsResource\Pages;

use App\Filament\Admin\Resources\RealEstate\UintsResource;
use Filament\Actions;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;

class ViewUints extends ViewRecord{
    use ViewTranslatable;
    protected static string $resource = UintsResource::class;

    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }
}
