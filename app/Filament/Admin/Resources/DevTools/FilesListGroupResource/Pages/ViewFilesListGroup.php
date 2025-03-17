<?php

namespace App\Filament\Admin\Resources\DevTools\FilesListGroupResource\Pages;

use App\Filament\Admin\Resources\DevTools\FilesListGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFilesListGroup extends ViewRecord {
    protected static string $resource = FilesListGroupResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\EditAction::make(),
        ];
    }
}
