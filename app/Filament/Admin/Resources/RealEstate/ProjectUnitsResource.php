<?php

namespace App\Filament\Admin\Resources\RealEstate;

use App\Enums\RealEstate\EnumsRealEstateDatabaseTable;
use App\Filament\Admin\Resources\RealEstate\_Custom\FormUnitsOptions;
use App\Filament\Admin\Resources\RealEstate\_Custom\PrintListingDates;
use App\Filament\Admin\Resources\RealEstate\_Custom\PrintListingName;
use App\Filament\Admin\Resources\RealEstate\_Custom\PrintProjectInfo;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableUnitFilters;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableUnitsDefault;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableUnitsToggleable;
use App\Filament\Admin\Resources\RealEstate\ProjectUnitsResource\Pages;
use App\FilamentCustom\Form\TextInputSlug;
use App\FilamentCustom\Form\TextNameTextEditor;;
use App\FilamentCustom\Form\WebpImageUpload;
use App\FilamentCustom\Table\CreatedDates;
use App\FilamentCustom\Table\ImageColumnDef;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use App\Models\Admin\RealEstate\ProjectUnits;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class ProjectUnitsResource extends Resource {
    use Translatable;

//    protected static ?string $model = Listing::class;
    protected static ?string $model = ProjectUnits::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $recordTitleAttribute = 'name:en';
    protected static ?int $navigationSort = 1;

    public static function getRecordTitle(?Model $record): Htmlable|string|null {
        return $record->translation->name ?? null;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getNavigationGroup(): ?string {
        return __('filament/RealEstate/listing.navigation_group');
    }

    public static function getNavigationLabel(): string {
        return __('filament/RealEstate/listing.unit.NavigationLabel');
    }

    public static function getModelLabel(): string {
        return __('filament/RealEstate/listing.unit.ModelLabel');
    }

    public static function getPluralModelLabel(): string {
        return __('filament/RealEstate/listing.unit.PluralModelLabel');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function form(Form $form): Form {

        $updateSlug = EnumsRealEstateDatabaseTable::DataProjectsUpdateSlug->value;

        return $form->schema([
            Hidden::make('listing_type')->default('Units'),

            Group::make()->schema([
                Section::make()->schema([
                    WebpImageUpload::make('photo')
                        ->uploadDirectory('images/quiz')
                        ->resize(300, 300, 90)
                        ->nullable(),
                ]),
                ...FormUnitsOptions::make()->getColumns(),
            ])->columnSpan(1),

            Group::make()->schema([
                TextInputSlug::make('slug')->permission($updateSlug),
                TranslatableTabs::make('translations')
                    ->availableLocales(['ar', 'en'])
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        ...TextNameTextEditor::make()->getColumns($tab),
                    ]),
            ])->columnSpan(2),

        ])->columns(3);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function table(Table $table): Table {
        return $table
//            ->query(fn() => Listing::query()->units())
            ->columns([
                TextColumn::make('id')->label('')->sortable()->searchable(),
                ImageColumnDef::make('photo_thumbnail'),
                ...TableUnitsDefault::make()->toggleable(false)->getColumns(),
                ...TableUnitsToggleable::make()->toggleable(true)->getColumns(),
                ...CreatedDates::make()->toggleable(true)->getColumns(),
            ])->filters([
                ...TableUnitFilters::make()->printLabel(false)->getColumns(),
                TrashedFilter::make()->label(''),
            ], layout: FiltersLayout::AboveContent)
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->actions([
                Tables\Actions\ViewAction::make()->hidden(fn($record) => $record->trashed())->iconButton(),
                Tables\Actions\EditAction::make()->hidden(fn($record) => $record->trashed())->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(fn($record) => static::getTableRecordUrl($record))
            ->defaultSort('id', 'desc');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getPages(): array {
        return [
            'index' => Pages\ListProjectUnits::route('/'),
            'create' => Pages\CreateProjectUnits::route('/create'),
//            'view' => Pages\ViewProjectUnits::route('/{record}'),
            'edit' => Pages\EditProjectUnits::route('/{record}/edit'),
        ];
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getTableRecordUrl($record): ?string {
        return static::getUrl('edit', ['record' => $record->getKey()]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function infolist(Infolist $infolist): Infolist {
        return $infolist
            ->schema([
                ...PrintListingName::make()->setSeo(true)->getColumns(),
                ...PrintProjectInfo::make()->getColumns(),
                ...PrintListingDates::make()->getColumns(),
            ]);
    }


}
