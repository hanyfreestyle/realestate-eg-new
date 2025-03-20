<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;


use App\Enums\RealEstate\EnumProjectStatus;
use App\Enums\RealEstate\EnumProjectType;
use App\FilamentCustom\View\TextEntryWithView;
use Filament\Infolists\Components\Group;

class PrintPropertyInfo {
    protected bool $toggleable = true;

    public static function make(): static {
        return new static();
    }

    public function getColumns(): array {
        return [
            Group::make()->schema([

                TextEntryWithView::make('project_type')
                    ->label(__('filament/RealEstate/listing.project_label.project_type'))
                    ->state(fn($record) => EnumProjectType::tryFrom($record->project_type)?->label()),

                TextEntryWithView::make('status')
                    ->label(__('filament/RealEstate/listing.project_label.status'))
                    ->state(fn($record) => EnumProjectStatus::tryFrom($record->status)?->label()),

                TextEntryWithView::make('location.name')
                    ->label(__('filament/RealEstate/listing.project_label.location_id')),

                TextEntryWithView::make('developer.name')
                    ->label(__('filament/RealEstate/listing.project_label.developer_id')),

                TextEntryWithView::make('delivery_date')
                    ->label(__('filament/RealEstate/listing.project_label.delivery_date')),

                TextEntryWithView::make('price')
                    ->label(__('filament/RealEstate/listing.project_label.price'))
                    ->state(fn($record) => number_format($record->price)),

                TextEntryWithView::make('units_count')
                    ->label(__('filament/RealEstate/listing.project_label.units_count'))
                    ->state(fn($record) => $record->units()->count()),

            ])->columnSpanFull()->columns(4)
        ];
    }

}

