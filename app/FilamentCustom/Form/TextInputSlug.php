<?php

namespace App\FilamentCustom\Form;


use Filament\Forms\Components\TextInput;


class TextInputSlug extends TextInput {
    protected ?string $locale = "en";
    protected ?string $updateSlugPermission = null;

    public function setLocale(string $locale): static {
        $this->locale = $locale;

        return $this->extraAttributes(fn() => [
            'dir' => $this->locale === 'ar' ? 'rtl' : 'ltr',
            'style' => 'text-align: ' . ($this->locale === 'ar' ? 'right' : 'left') . ';',
        ]);
    }

    public function setPermission(string $permission): static {
        $this->updateSlugPermission = $permission;

        return $this;
    }

    public static function make(string $name): static {

        return parent::make($name)
            ->label(__('filament/def.label.slug'))
            ->unique(ignoreRecord: true)
            ->extraAttributes(fn() => rtlIfArabic('en'))
//            ->disabled(fn() => !auth()->user()->can($updateSlug) && request()->routeIs('*.edit'))
            ->afterStateUpdated(function ($state, callable $set) use ($name) {
                $slug = Url_Slug($state);
                $set($name, $slug);
            })
            ->beforeStateDehydrated(function ($state) {
                return Url_Slug($state);
            })
            ->required();

    }



}

