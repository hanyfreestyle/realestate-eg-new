<?php

namespace App\Filament\Admin\Resources\RealEstate;

use App\Enums\RealEstate\EnumsRealEstateDatabaseTable;
use App\Filament\Admin\Resources\RealEstate\DeveloperResource\Pages;
use App\FilamentCustom\Form\CKEditor;
use App\FilamentCustom\Form\CKEditor4;
use App\FilamentCustom\Form\TextNameTextEditor;
use App\Models\Admin\RealEstate\Developer;
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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class DeveloperResource extends Resource {
    use Translatable;

    protected static ?string $model = Developer::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $recordTitleAttribute = 'name:en';
    protected static ?int $navigationSort = -9000;

    public static function getRecordTitle(?Model $record): Htmlable|string|null {
        return $record->translation->name ?? null;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getNavigationGroup(): ?string {
        return __('filament/RealEstate/data.navigation_group');
    }

    public static function getNavigationLabel(): string {
        return __('filament/RealEstate/data.developer.NavigationLabel');
    }

    public static function getModelLabel(): string {
        return __('filament/RealEstate/data.developer.ModelLabel');
    }

    public static function getPluralModelLabel(): string {
        return __('filament/RealEstate/data.developer.PluralModelLabel');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function form(Form $form): Form {

        $translationTable = EnumsRealEstateDatabaseTable::DataDevelopersTranslation->value;
        $updateSlug = EnumsRealEstateDatabaseTable::DataDevelopersUpdateSlug->value;

        return $form->schema([
            Group::make()->schema([

//                CKEditor::make('content'),


                TranslatableTabs::make('translations')
                    ->availableLocales(['ar', 'en'])
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        ...TextNameTextEditor::make()->getColumns($tab, $translationTable, $updateSlug),

//                        Textarea::make($tab->makeName('des')),

//                        CKEditor4::make($tab->makeName('des'))
//                        ->label(__('المحتوى'))
//                            ->required()
//                            ->reactive()
//                            ->extraAttributes([
//                                'locale' => $tab->getLocale(),
//                            ]),

                        CKEditor4::make($tab->makeName('des'))
                            ->label(__('المحتوى'))
                            ->required()
                            ->reactive()
                            ->extraAttributes([
                                'locale' => $tab->getLocale(),
                            ]),

                    ]),
            ])->columnSpan(2),

            Group::make()->schema([
                Section::make()->schema([
//                    WebpImageUpload::make('photo')
//                        ->uploadDirectory('images/quiz')
//                        ->resize(300, 300, 90)
//                        ->nullable(),
//
//                    Toggle::make('is_active')
//                        ->label(__('filament/def.is_active'))
//                        ->default(true)
//                        ->required(),
                ]),
            ])->columnSpan(1),
        ])->columns(3);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function table(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('id')->label("#")->sortable()->searchable(),
                ImageColumnDef::make('photo_thumbnail'),
                TranslationTextColumn::make('name'),
                IconColumn::make('is_active')->label(__('filament/def.is_active'))->boolean(),
                ...CreatedDates::make()->toggleable(true)->getColumns(),
            ])->filters([
                TrashedFilter::make(),
            ])
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->actions([
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
            ->defaultSort('id', 'desc');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public static function getRelations(): array {
        return [
            //
        ];
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getPages(): array {
        return [
            'index' => Pages\ListDevelopers::route('/'),
            'create' => Pages\CreateDeveloper::route('/create'),
//            'view' => Pages\ViewDeveloper::route('/{record}'),
            'edit' => Pages\EditDeveloper::route('/{record}/edit'),
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
                ...PrintNameWithSlug::make()->setUUID(true)->setSeo(true)->getColumns(),
                ...PrintDatesWithIaActive::make()->getColumns(),
            ]);
    }


}
