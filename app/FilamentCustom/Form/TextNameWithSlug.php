<?php

namespace App\FilamentCustom\Form;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class TextNameWithSlug {
    protected bool $toggleable = true;

    public static function make(): static {
        return new static();
    }

    public function toggleable(bool $value = true): static {
        $this->toggleable = $value;
        return $this;
    }

    public function getColumns($tab, $translationTable,$updateSlug): array {
        return [
            TextInput::make($tab->makeName('name'))
                ->label(__('filament/def.label.name'))
                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                ->live(onBlur: true) // هنخليه reactive مع delay خفيف
                ->afterStateUpdated(function ($state, callable $get, callable $set) use ($tab) {
                    $slugField = $tab->makeName('slug');
                    // لو الحقل slug لسه فاضي، نحقن فيه قيمة slugify من name
                    if (blank($get($slugField))) {
                        $set($slugField, Url_Slug($state));
                    }
                })
                ->required(),

            TranslatableSlugInput::make($tab->makeName('slug'))
                ->setLocale($tab->getLocale())
                ->disabled(fn() => !auth()->user()->can($updateSlug) && request()->routeIs('*.edit'))
                ->uniqueForLocale($translationTable, 'slug')
//                ->extraInputAttributes([
//                    'tabindex' => '-1',
//                ])
                ->required(),

            TextInput::make($tab->makeName('g_title'))
                ->label(__('filament/def.label.g_title'))
                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                ->nullable(),

            Textarea::make($tab->makeName('g_des'))
                ->label(__('filament/def.label.g_des'))
                ->rows(6)
                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                ->nullable(),

        ];
    }

}
