<?php

namespace App\FilamentCustom\Form;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class TextNameTextEditor {
    protected bool $toggleable = true;

    public static function make(): static {
        return new static();
    }

    public function toggleable(bool $value = true): static {
        $this->toggleable = $value;
        return $this;
    }

    public function getColumns($tab, $translationTable, $updateSlug): array {
        return [
            TextInput::make($tab->makeName('name'))
                ->label(__('filament/def.label.name'))
                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                ->required(),

//            TextInput::make($tab->makeName('g_title'))
//                ->label(__('filament/def.label.g_title'))
//                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
//                ->nullable(),
//
//            Textarea::make($tab->makeName('g_des'))
//                ->label(__('filament/def.label.g_des'))
//                ->rows(6)
//                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
//                ->nullable(),

        ];
    }

}
