<?php

namespace App\Filament\Admin\Resources\RealEstate\ProjectResource\Pages;

use App\Filament\Admin\Resources\RealEstate\ProjectResource;
use Filament\Actions;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord{
    use CreateTranslatable;
    protected static string $resource = ProjectResource::class;
    protected static bool $canCreateAnother = false;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getFormActions(): array {
        return [
            ...parent::getFormActions(),
            Action::make('saveAndCreateAnother')
                ->label(__('filament/def.but.save_and_create_another'))
                ->color('warning')
                ->action('saveAndCreateAnother'),
        ];
    }

    public function saveAndCreateAnother(): void {
        $this->createAnother();
        $this->redirect($this->getResource()::getUrl('create')); // التوجيه إلى index
    }

    //customize redirect after create
    public function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }

}
