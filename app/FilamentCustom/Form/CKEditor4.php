<?php

namespace App\FilamentCustom\Form;

use Filament\Forms\Components\Field;

class CKEditor4 extends Field {
    protected string $view = 'components.custom.ckeditor4';

    protected function setUp(): void {
        parent::setUp();

        $this->afterStateHydrated(function (CKEditor $component, $state) {
            $component->state($state ?? '');
        });
    }

    public function getLocale(): string {
        return $this->getExtraAttributes()['locale'] ?? app()->getLocale();
    }

}
