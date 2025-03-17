<?php

namespace App\Filament\Admin\Resources\Data;

use App\Enums\EnumsDatabaseTable;
use App\Filament\Admin\Resources\Data\DataCountryResource\Pages;
use App\FilamentCustom\Form\TranslatableSlugInput;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use App\Models\Admin\Data\DataCountry;
use App\Policies\Admin\Data\DataCountryPolicy;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class DataCountryResource extends Resource {
    use Translatable;

    protected static ?string $model = DataCountry::class;
    protected static ?string $navigationIcon = 'heroicon-s-flag';
    protected static ?string $recordTitleAttribute = 'name:en';
    protected static ?int $navigationSort = -5;


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getNavigationGroup(): ?string {
        return __('filament/data/country.navigation_group');
    }

    public static function getNavigationLabel(): string {
        return __('filament/data/country.category.NavigationLabel');
    }

    public static function getModelLabel(): string {
        return __('filament/data/country.category.ModelLabel');
    }

    public static function getPluralModelLabel(): string {
        return __('filament/data/country.category.PluralModelLabel');
    }

    public static function getRecordTitle(?Model $record): Htmlable|string|null {
        return $record->translation->name ?? null;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function form(Form $form): Form {
        return $form
            ->schema([

                Group::make()->schema([
                    TranslatableTabs::make('translations')
                        ->availableLocales(['ar', 'en'])
                        ->localeTabSchema(fn(TranslatableTab $tab) => [

                            TextInput::make($tab->makeName('name'))
                                ->label(__('filament/data/country.label.name'))
                                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                                ->required(),

                            TranslatableSlugInput::make($tab->makeName('slug'))
                                ->setLocale($tab->getLocale()) // تحديد اللغة لاتجاه النص
                                ->uniqueForLocale(EnumsDatabaseTable::DataCountryTranslation->value, 'slug'),

                            TextInput::make($tab->makeName('capital'))
                                ->label(__('filament/data/country.label.capital'))
                                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                                ->nullable(),

                            TextInput::make($tab->makeName('currency'))
                                ->label(__('filament/data/country.label.currency'))
                                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                                ->nullable(),

                            TextInput::make($tab->makeName('continent'))
                                ->label(__('filament/data/country.label.continent'))
                                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                                ->nullable(),

                            TextInput::make($tab->makeName('nationality'))
                                ->label(__('filament/data/country.label.nationality'))
                                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                                ->nullable(),

                            TextInput::make($tab->makeName('g_title'))
                                ->label(__('filament/def.label.g_title'))
                                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                                ->nullable(),

                            Textarea::make($tab->makeName('g_des'))
                                ->label(__('filament/def.label.g_des'))
                                ->rows(6)
                                ->extraAttributes(fn() => rtlIfArabic($tab->getLocale()))
                                ->nullable(),

                        ])->columns(2),
                ])->columnSpan(2),

                Group::make()->schema([

                    Section::make()->schema([
                        Toggle::make('is_active')
                            ->label(__('filament/def.is_active'))
                            ->columnSpanFull()
                            ->required(),

                        TextInput::make('iso2')
                            ->label('ISO2')
                            ->unique(ignoreRecord: true)
                            ->maxLength(2)
                            ->default(null),

                        TextInput::make('iso3')
                            ->label('ISO3')
                            ->maxLength(3)
                            ->default(null),

                        TextInput::make('fips')
                            ->label('FIPS')
                            ->maxLength(3)
                            ->default(null),

                        TextInput::make('iso_numeric')
                            ->label('Iso Numeric')
                            ->maxLength(3)
                            ->default(null),

                        TextInput::make('phone')
                            ->label(__('filament/data/country.label.phone'))
                            ->default(null),

                        TextInput::make('symbol')
                            ->label(__('filament/data/country.label.symbol'))
                            ->maxLength(10)
                            ->default(null),
                        TextInput::make('currency_code')
                            ->label(__('filament/data/country.label.currency_code'))
                            ->maxLength(3)
                            ->default(null),
                        TextInput::make('continent_code')
                            ->label(__('filament/data/country.label.continent_code'))
                            ->maxLength(2)
                            ->default(null),
                        TextInput::make('language_codes')
                            ->label(__('filament/data/country.label.language_codes'))
                            ->maxLength(255)
                            ->default(null),
                        TextInput::make('top_level_domain')
                            ->label(__('filament/data/country.label.top_level_domain'))
                            ->maxLength(5)
                            ->default(null),
                        TextInput::make('time_zone')
                            ->label(__('filament/data/country.label.time_zone'))
                            ->maxLength(255)
                            ->default(null),
                        TextInput::make('area_km')
                            ->label(__('filament/data/country.label.area_km'))
                            ->maxLength(255)
                            ->default(null),


                    ])->columns(2),


                ])->columnSpan(1),


            ])->columns(3);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function table(Table $table): Table {
        return $table
            ->columns([

                ImageColumn::make('flag')
                    ->label('')
                    ->disk('flag')
                    ->width(30)
                    ->height(30)
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('filament/data/country.label.name'))
                    ->sortable(query: fn($query, $direction) => $query->orderByCurrentLocaleTranslation('name', $direction))
                    ->searchable(query: fn($query, $search) => $query->whereCurrentLocaleTranslationLike('name', "%{$search}%")),

                TextColumn::make('capital')
                    ->label(__('filament/data/country.label.capital'))
                    ->sortable(query: fn($query, $direction) => $query->orderByCurrentLocaleTranslation('capital', $direction))
                    ->searchable(query: fn($query, $search) => $query->whereCurrentLocaleTranslationLike('capital', "%{$search}%")),

                TextColumn::make('currency')
                    ->label(__('filament/data/country.label.currency'))
                    ->sortable(query: fn($query, $direction) => $query->orderByCurrentLocaleTranslation('currency', $direction))
                    ->searchable(query: fn($query, $search) => $query->whereCurrentLocaleTranslationLike('currency', "%{$search}%")),

                TextColumn::make('continent')
                    ->label(__('filament/data/country.label.continent'))
                    ->sortable(query: fn($query, $direction) => $query->orderByCurrentLocaleTranslation('continent', $direction))
                    ->searchable(query: fn($query, $search) => $query->whereCurrentLocaleTranslationLike('continent', "%{$search}%")),

                TextColumn::make('iso2')
                    ->label('ISO2')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('iso3')
                    ->label('ISO3')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('fips')
                    ->label('FIPS')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('iso_numeric')
                    ->label('ISO Numeric')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                    ->label(__('filament/data/country.label.phone'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('symbol')
                    ->label(__('filament/data/country.label.symbol'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('currency_code')
                    ->label(__('filament/data/country.label.currency_code'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('continent_code')
                    ->label(__('filament/data/country.label.continent_code'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('language_codes')
                    ->label(__('filament/data/country.label.language_codes'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('top_level_domain')
                    ->label(__('filament/data/country.label.top_level_domain'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('time_zone')
                    ->label(__('filament/data/country.label.time_zone'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('area_km')
                    ->label(__('filament/data/country.label.area_km'))
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('is_active')
                    ->visible(fn () => auth()->user()->can('update_admin::data::data::country'))
                    ->label(__('filament/def.is_active')),

            ])
            ->filters([
                //
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(fn($record) => static::getTableRecordUrl($record))
            // ->reorderable('position')
            ->defaultSort('id', 'desc');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListDataCountries::route('/'),
            'create' => Pages\CreateDataCountry::route('/create'),
            'view' => Pages\ViewDataCountry::route('/{record}'),
            'edit' => Pages\EditDataCountry::route('/{record}/edit'),
        ];
    }


    public static function getTableRecordUrl($record): ?string {
        return static::getUrl('edit', ['record' => $record->getKey()]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public static function infolist(Infolist $infolist): Infolist {
//        return $infolist
//            ->schema([
//                TextEntry::make('id'),
//                TextEntry::make('name')
//                    ->label(__('filament/def.tableHeader.name')),
//
//                \Filament\Infolists\Components\Group::make()->schema([
//                    IconEntry::make('is_active')
//                        ->label(__('filament/def.tableHeader.active'))
//                        ->boolean(),
//
//                    IconEntry::make('is_feature')
//                        ->label(__('filament/def.tableHeader.feature'))
//                        ->boolean(),
//
//                    IconEntry::make('is_archived')
//                        ->label(__('filament/def.tableHeader.archived'))
//                        ->boolean(),
//                ])->columnSpanFull()->columns(3),
//
//
//                TextEntry::make('notes')
//                    ->label(__('filament/def.tableHeader.notes'))
//                    ->limit(50)
//                    ->words(10)
//                    ->lineClamp(2)
//                    ->listWithLineBreaks()
//                    ->columnSpanFull(),
//
//                TextEntry::make('temp')
//                    ->label(__('filament/def.tableHeader.name'))
//                    ->dateTime()
//                    ->money('EUR', divideBy: 100)
//                    ->since(),
//            ]);
//    }


}
