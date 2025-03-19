<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;


use App\Enums\RealEstate\EnumProjectStatus;
use App\Enums\RealEstate\EnumProjectType;
use App\Models\Admin\RealEstate\Amenity;
use App\Traits\RealEstate\ListingCashDataTrait;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class FormProjectOptions {
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
                    Select::make('project_type')
                        ->label(__('filament/RealEstate/listing.project_label.project_type'))
                        ->options(EnumProjectType::options())
                        ->required()
                        ->searchable()
                        ->preload(),

                    Select::make('status')
                        ->label(__('filament/RealEstate/listing.project_label.status'))
                        ->options(EnumProjectStatus::options())
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
                    TextInput::make('latitude')
                        ->label(__('filament/RealEstate/listing.project_label.latitude'))
                        ->extraAttributes(fn() => rtlIfArabic('en'))
                        ->nullable(),

                    TextInput::make('longitude')
                        ->label(__('filament/RealEstate/listing.project_label.longitude'))
                        ->extraAttributes(fn() => rtlIfArabic('en'))
                        ->nullable(),

                    TextInput::make('youtube_url')
                        ->label(__('filament/RealEstate/listing.project_label.youtube_url'))
                        ->extraAttributes(fn() => rtlIfArabic('en'))
                        ->columnSpanFull()
                        ->nullable(),

                ])->columns(2),

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

            Section::make(__('filament/RealEstate/listing.project_label.amenity'))->schema([
                CheckboxList::make('amenity')
                    ->label('')
                    ->options(
                        Amenity::with('translations')
                            ->get()
                            ->pluck('name', 'id')
                    )
                    ->required()
                    ->minItems(2)
                    ->columns(2)
                    ->bulkToggleable() // دي اللي هتعمل "تحديد الكل / إلغاء تحديد الكل" زي الصورة
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', app()->getLocale())),
            ]),
        ];
    }

}

