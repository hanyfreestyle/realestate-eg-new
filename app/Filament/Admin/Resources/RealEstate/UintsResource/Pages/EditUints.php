<?php

namespace App\Filament\Admin\Resources\RealEstate\UintsResource\Pages;

use App\Filament\Admin\Resources\RealEstate\UintsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditUints extends EditRecord{
    protected static string $resource = UintsResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    use EditTranslatable;

    protected function getHeaderActions(): array {
        return [
            Actions\DeleteAction::make(),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getFormActions(): array {
        return [
            ...parent::getFormActions(),
            Action::make('saveAndClose')
                ->label(__('filament/def.but.save_and_close'))
                ->color('warning')
                ->action('saveAndClose'),
        ];
    }

    public function saveAndClose(): void {
        $this->save(); // حفظ التعديلات
        $this->redirect($this->getResource()::getUrl('index')); // التوجيه إلى index
    }

}
