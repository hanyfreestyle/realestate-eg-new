<?php

namespace App\FilamentCustom\Form;

use Filament\Forms\Components\Field;

class CKEditor4 extends Field {
    protected string $view = 'components.custom.ckeditor4';

    protected function setUp(): void {
        parent::setUp();

        $this->afterStateHydrated(function (CKEditor4 $component, $state) {
            $component->state($state ?? '');
        });
    }

}
