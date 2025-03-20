<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;

use App\Enums\RealEstate\EnumPropertyType;
use App\FilamentCustom\Table\TranslationTextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class TableUnitsDefault {
    protected bool $toggleable = true;
    protected bool $isProject = true;
    protected bool $isRelationship = false;

    public static function make(): static {
        return new static();
    }

    public function toggleable(bool $value = true): static {
        $this->toggleable = $value;
        return $this;
    }

    public function isProject(bool $value = true): static {
        $this->isProject = $value;
        return $this;
    }

    public function isRelationship(bool $value = false): static {
        $this->isRelationship = $value;
        return $this;
    }


    public function getColumns(): array {

        $columns = [
            TranslationTextColumn::make('name')
                ->label(__('filament/RealEstate/listing.units_label.name'))
                ->limit('40')
                ->toggleable(isToggledHiddenByDefault: false),
        ];
        if ($this->isProject) {
            $columns[] = TextColumn::make('project.name')
                ->label(__('filament/RealEstate/listing.project_label.name'))
                ->limit('20')
                ->toggleable(isToggledHiddenByDefault: false);
        }

        $columns[] = TextColumn::make('property_type')
            ->label(__('filament/RealEstate/listing.project_label.property_type'))
            ->formatStateUsing(fn($state) => EnumPropertyType::tryFrom($state)?->label())
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: false);

        if (!$this->isRelationship) {

            $columns[] = TextColumn::make('location.name')
                ->label(__('filament/RealEstate/listing.project_label.location_id'))
                ->sortable()->searchable()
                ->toggleable(isToggledHiddenByDefault: false);

            $columns[] = TextColumn::make('developer.name')
                ->label(__('filament/RealEstate/listing.project_label.developer_id'))
                ->sortable()->searchable()
                ->limit('25')
                ->toggleable(isToggledHiddenByDefault: false);
        }


        $columns[] = IconColumn::make('is_published')
            ->label(__('filament/def.is_active'))->boolean()
            ->toggleable(isToggledHiddenByDefault: true);

        return $columns;

//        return [
//            TranslationTextColumn::make('name')
//                ->label(__('filament/RealEstate/listing.units_label.name'))
//                ->limit('40')
//                ->toggleable(isToggledHiddenByDefault: false),
//
//            TextColumn::make('project.name')
//                ->label(__('filament/RealEstate/listing.project_label.name'))
//                ->limit('20')
//                ->toggleable(isToggledHiddenByDefault: false),
//
//            TextColumn::make('property_type')
//                ->label(__('filament/RealEstate/listing.project_label.property_type'))
//                ->formatStateUsing(fn($state) => EnumPropertyType::tryFrom($state)?->label())
//                ->sortable()
//                ->toggleable(isToggledHiddenByDefault: false),
//
//            TextColumn::make('location.name')
//                ->label(__('filament/RealEstate/listing.project_label.location_id'))
//                ->sortable()->searchable()
//                ->toggleable(isToggledHiddenByDefault: false),
//
//            TextColumn::make('developer.name')
//                ->label(__('filament/RealEstate/listing.project_label.developer_id'))
//                ->sortable()->searchable()
//                ->limit('25')
//                ->toggleable(isToggledHiddenByDefault: false),
//
//            IconColumn::make('is_published')->label(__('filament/def.is_active'))->boolean()
//                ->toggleable(isToggledHiddenByDefault: true),
//
//        ];
    }

}
