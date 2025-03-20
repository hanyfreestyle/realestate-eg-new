<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;


use App\Enums\RealEstate\EnumProjectStatus;
use App\Enums\RealEstate\EnumProjectType;
use App\Enums\RealEstate\EnumPropertyType;
use App\Enums\RealEstate\EnumPropertyView;
use App\FilamentCustom\View\TextEntryWithView;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;

class PrintProjectInfo {
    protected bool $toggleable = true;

    public static function make(): static {
        return new static();
    }

    public function getColumns(): array {
        return [
            Group::make()->schema([

                TextEntryWithView::make('property_type')
                    ->label(__('filament/RealEstate/listing.project_label.property_type'))
                    ->state(fn($record) => EnumPropertyType::tryFrom($record->property_type)?->label()),

                TextEntryWithView::make('view')
                    ->label(__('filament/RealEstate/listing.project_label.view'))
                    ->state(fn($record) => EnumPropertyView::tryFrom($record->view)?->label()),

                TextEntryWithView::make('location.name')
                    ->label(__('filament/RealEstate/listing.project_label.location_id')),

                TextEntryWithView::make('developer.name')
                    ->label(__('filament/RealEstate/listing.project_label.developer_id')),


                TextEntryWithView::make('price')
                    ->label(__('filament/RealEstate/listing.project_label.price'))
                    ->state(fn($record) => number_format($record->price)),
                TextEntryWithView::make('area')
                    ->label(__('filament/RealEstate/listing.project_label.area'))
                    ->state(fn($record) => number_format($record->area)),

                TextEntryWithView::make('baths')
                    ->label(__('filament/RealEstate/listing.project_label.baths'))
                    ->state(fn($record) => number_format($record->baths)),

                TextEntryWithView::make('rooms')
                    ->label(__('filament/RealEstate/listing.project_label.rooms'))
                    ->state(fn($record) => number_format($record->rooms)),

            ])->columnSpanFull()->columns(4)
        ];
    }

}

