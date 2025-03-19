<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;

use App\Enums\RealEstate\EnumProjectStatus;
use Filament\Tables\Columns\TextColumn;

class TableProjectToggleable {
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
            TextColumn::make('delivery_date')
                ->label(__('filament/RealEstate/listing.project_label.delivery_date'))
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $this->toggleable),
            TextColumn::make('status')
                ->label(__('filament/RealEstate/listing.project_label.status'))
                ->formatStateUsing(fn($state) => EnumProjectStatus::tryFrom($state)?->label())
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: $this->toggleable),

        ];
    }

}
