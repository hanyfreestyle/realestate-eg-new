<?php
namespace App\Filament\Admin\Resources\RealEstate;

use App\Filament\Admin\Resources\RealEstate\UintsResource\Pages;
use App\Models\Admin\RealEstate\Listing;
use App\FilamentCustom\View\PrintDatesWithIaActive;
use App\FilamentCustom\View\PrintNameWithSlug;
use App\FilamentCustom\Form\TextNameWithSlug;
use App\FilamentCustom\Form\WebpImageUpload;
use App\FilamentCustom\Table\CreatedDates;
use App\FilamentCustom\Table\ImageColumnDef;
use App\FilamentCustom\Table\TranslationTextColumn;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\Group;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class UintsResource extends Resource{
    use Translatable;
    protected static ?string $model = Listing::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
//    protected static ?string $navigationIcon = 'heroicon-o-key';
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

//        $translationTable = EnumsQuizDatabaseTable::DataQuizDataClassTranslation->value;
//        $updateSlug = EnumsQuizDatabaseTable::DataQuizDataClassUpdateSlug->value;

        return $form->schema([
            Group::make()->schema([
                TranslatableTabs::make('translations')
                    ->availableLocales(['ar', 'en'])
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        ...TextNameWithSlug::make()->getColumns($tab, $translationTable, $updateSlug),
                    ]),
            ])->columnSpan(2),

            Group::make()->schema([
                Section::make()->schema([
                    WebpImageUpload::make('photo')
                        ->uploadDirectory('images/quiz')
                        ->resize(300, 300, 90)
                        ->nullable(),

                    WebpImageUpload::make('icon')
                        ->uploadDirectory('images/quiz')
                        ->resize(300, 300, 90)
                        ->nullable(),

                    Toggle::make('is_active')
                        ->label(__('filament/def.is_active'))
                        ->default(true)
                        ->required(),
                ]),
            ])->columnSpan(1),
        ])->columns(3);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function table(Table $table): Table {
        return $table
            ->columns([
                ImageColumnDef::make('photo_thumbnail'),
                ImageColumnDef::make('icon')->circular(),
                TranslationTextColumn::make('name'),
                IconColumn::make('is_active')->label(__('filament/def.is_active'))->boolean(),
                ...CreatedDates::make()->toggleable(true)->getColumns(),
            ])->filters([
                TrashedFilter::make(),
            ])
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->actions([
//                ActionGroup::make([
//
//                ]),
                Tables\Actions\ViewAction::make()->iconButton(),
                Tables\Actions\EditAction::make()->hidden(fn($record) => $record->trashed()),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(fn($record) => static::getTableRecordUrl($record))
            // ->reorderable('position')
            ->defaultSort('id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getPages(): array{
        return [
                        'index' => Pages\ListUints::route('/'),
            'create' => Pages\CreateUints::route('/create'),
            'view' => Pages\ViewUints::route('/{record}'),
            'edit' => Pages\EditUints::route('/{record}/edit'),
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
//                InfolistSection::make('')
//                    ->schema([
//
//                    ])->columns(5),
                ...PrintNameWithSlug::make()->setUUID(true)->setSeo(true)->getColumns() ,
                ...PrintDatesWithIaActive::make()->getColumns() ,
            ]);
    }


}
