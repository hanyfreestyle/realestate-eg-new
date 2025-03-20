<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;

use App\Enums\RealEstate\EnumProjectStatus;
use App\Enums\RealEstate\EnumPropertyView;
use Filament\Tables\Columns\TextColumn;

class TableUnitsToggleable {
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
            TextColumn::make('price')
                ->label(__('filament/RealEstate/listing.project_label.price'))
                ->formatStateUsing(fn($state) => number_format($state))
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $this->toggleable),
            TextColumn::make('view')
                ->label(__('filament/RealEstate/listing.project_label.view'))
                ->formatStateUsing(fn($state) => EnumPropertyView::tryFrom($state)?->label())
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $this->toggleable),

            TextColumn::make('area')
                ->label(__('filament/RealEstate/listing.project_label.area'))
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $this->toggleable),
            TextColumn::make('baths')
                ->label(__('filament/RealEstate/listing.project_label.baths'))
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $this->toggleable),

            TextColumn::make('rooms')
                ->label(__('filament/RealEstate/listing.project_label.rooms'))
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $this->toggleable),

        ];
    }

}
