<?php

namespace App\FilamentCustom\Form;


use Filament\Forms\Components\TextInput;


class TextInputSlug extends TextInput {
    protected ?string $locale = 'en';
    protected ?string $permission = "no-edit";

    // Factory Method make
    public static function make(string $name): static {
        $instance = parent::make($name);
        $instance->label(__('filament/def.label.slug'))
            ->unique(ignoreRecord: true)
            ->afterStateUpdated(function ($state, callable $set) use ($name) {
                $slug = Url_Slug($state);
                $set($name, $slug);
            })
            ->beforeStateDehydrated(function ($state) {
                return Url_Slug($state);
            })
            ->required();
        return $instance;
    }

    // Setter للـ locale
    public function locale(string $locale): static {
        $this->locale = $locale;
        return $this;
    }

    // Setter للـ permission
    public function permission(string $permission): static {
        $this->permission = $permission;
        return $this;
    }

    // إعدادات افتراضية و dynamic behavior
    protected function setUp(): void {
        parent::setUp();

        $this->extraAttributes(function () {
            return [
                'dir' => $this->locale === 'ar' ? 'rtl' : 'ltr',
                'style' => 'text-align: ' . ($this->locale === 'ar' ? 'right' : 'left') . ';',
            ];
        });

        $this->disabled(function () {
            return $this->permission
                ? (!auth()->user()->can($this->permission) && request()->routeIs('*.edit'))
                : false;
        });
    }


}

