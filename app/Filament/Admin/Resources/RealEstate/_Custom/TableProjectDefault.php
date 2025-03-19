<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;

use App\Enums\RealEstate\EnumProjectType;
use App\FilamentCustom\Table\TranslationTextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class TableProjectDefault {
    protected bool $toggleable = true;

    public static function make(): static {
        return new static();
    }

    public function toggleable(bool $value = true): static {
        $this->toggleable = $value;
        return $this;
    }

    public function getColumns(): array {
        return [
            TranslationTextColumn::make('name')
                ->label(__('filament/RealEstate/listing.project_label.name'))
                ->limit('40')
                ->toggleable(isToggledHiddenByDefault: false),

            TextColumn::make('project_type')
                ->label(__('filament/RealEstate/listing.project_label.project_type'))
                ->formatStateUsing(fn ($state) => EnumProjectType::tryFrom($state)?->label())
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),

            TextColumn::make('location.name')
                ->label(__('filament/RealEstate/listing.project_label.location_id'))
                ->sortable()->searchable()
                ->toggleable(isToggledHiddenByDefault: false),

            TextColumn::make('developer.name')
                ->label(__('filament/RealEstate/listing.project_label.developer_id'))
                ->sortable()->searchable()
                ->limit('25')
                ->toggleable(isToggledHiddenByDefault: false),

            IconColumn::make('is_published')->label(__('filament/def.is_active'))->boolean()
                ->toggleable(isToggledHiddenByDefault: true),

        ];
    }

}
