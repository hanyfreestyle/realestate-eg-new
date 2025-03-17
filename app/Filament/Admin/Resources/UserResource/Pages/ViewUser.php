<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;


use App\Filament\Admin\Resources\UserResource;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord {
    protected static string $resource = UserResource::class;
    protected static bool $canCreateAnother = false;

    public function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

}
