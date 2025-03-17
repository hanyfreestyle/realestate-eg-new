<?php

namespace App\Filament\Admin\Resources\DevTools\FilesListResource\Pages;


use App\Filament\Admin\Resources\DevTools\FilesListResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFilesList extends ViewRecord {
    protected static string $resource = FilesListResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\EditAction::make(),
        ];
    }
}
