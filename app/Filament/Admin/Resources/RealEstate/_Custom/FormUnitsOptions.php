<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;

use App\Enums\RealEstate\EnumPropertyType;
use App\Enums\RealEstate\EnumPropertyView;
use App\Models\Admin\RealEstate\Amenity;
use App\Traits\RealEstate\ListingCashDataTrait;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class FormUnitsOptions {
    protected bool $toggleable = true;

    public static function make(): static {
        return new static();
    }


    public function getColumns(): array {
        return [

            Section::make()->schema([
                Group::make()->schema([
                    Select::make('developer_id')
                        ->label(__('filament/RealEstate/listing.project_label.developer_id'))
                        ->options(ListingCashDataTrait::getDataDeveloper(true))
                        ->required()
                        ->searchable()
                        ->preload(),

                    Select::make('location_id')
                        ->label(__('filament/RealEstate/listing.project_label.location_id'))
                        ->options(ListingCashDataTrait::getDataLocation(true))
                        ->required()
                        ->searchable()
                        ->preload(),

                ])->columns(1),

                Group::make()->schema([
                    Select::make('property_type')
                        ->label(__('filament/RealEstate/listing.project_label.property_type'))
                        ->options(EnumPropertyType::options())
                        ->required()
                        ->searchable()
                        ->preload(),

                    Select::make('view')
                        ->label(__('filament/RealEstate/listing.project_label.view'))
                        ->options(EnumPropertyView::options())
                        ->required()
                        ->searchable()
                        ->preload(),

                    TextInput::make('price')
                        ->label(__('filament/RealEstate/listing.project_label.price'))
                        ->extraAttributes(fn() => rtlIfArabic('en'))
                        ->columnSpanFull()
                        ->required(),

                ])->columns(2),

                Group::make()->schema([

                    TextInput::make('area')
                        ->label(__('filament/RealEstate/listing.project_label.area'))
                        ->extraAttributes(fn() => rtlIfArabic('en'))
                        ->required(),

                    TextInput::make('baths')
                        ->label(__('filament/RealEstate/listing.project_label.baths'))
                        ->extraAttributes(fn() => rtlIfArabic('en'))
                        ->required(),

                    TextInput::make('rooms')
                        ->label(__('filament/RealEstate/listing.project_label.rooms'))
                        ->extraAttributes(fn() => rtlIfArabic('en'))
                        ->required(),

                ])->columns(3),

//                Group::make()->schema([
//                    TextInput::make('latitude')
//                        ->label(__('filament/RealEstate/listing.project_label.latitude'))
//                        ->extraAttributes(fn() => rtlIfArabic('en'))
//                        ->nullable(),
//
//                    TextInput::make('longitude')
//                        ->label(__('filament/RealEstate/listing.project_label.longitude'))
//                        ->extraAttributes(fn() => rtlIfArabic('en'))
//                        ->nullable(),
//
//                    TextInput::make('youtube_url')
//                        ->label(__('filament/RealEstate/listing.project_label.youtube_url'))
//                        ->extraAttributes(fn() => rtlIfArabic('en'))
//                        ->columnSpanFull()
//                        ->nullable(),
//
//                ])->columns(2),

                Group::make()->schema([
                    Toggle::make('is_published')
                        ->label(__('filament/def.is_active'))
                        ->default(true)
                        ->required(),

                    Toggle::make('is_featured')
                        ->label(__('filament/RealEstate/listing.project_label.is_featured'))
                        ->default(true)
                        ->required(),
                ])->columns(2),

            ]),

        ];
    }

}

