<?php

namespace App\Filament\Admin\Resources\RealEstate\ProjectResource\Pages;

use App\Filament\Admin\Resources\RealEstate\ProjectResource;
use Filament\Actions;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord{
    use ViewTranslatable;
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }
}
