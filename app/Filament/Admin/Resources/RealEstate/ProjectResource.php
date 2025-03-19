<?php

namespace App\Filament\Admin\Resources\RealEstate;

use App\Enums\RealEstate\EnumsRealEstateDatabaseTable;
use App\Filament\Admin\Resources\RealEstate\_Custom\FormProjectOptions;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableProjectDefault;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableProjectFilters;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableProjectToggleable;
use App\Filament\Admin\Resources\RealEstate\ProjectResource\Pages;
use App\Filament\Admin\Resources\RealEstate\ProjectResource\RelationManagers\UnitsRelationManager;
use App\FilamentCustom\Form\TextInputSlug;
use App\FilamentCustom\Form\TextNameTextEditor;
use App\FilamentCustom\View\PrintDatesWithIaActive;
use App\FilamentCustom\View\PrintNameWithSlug;
use App\FilamentCustom\Form\WebpImageUpload;
use App\FilamentCustom\Table\CreatedDates;
use App\FilamentCustom\Table\ImageColumnDef;
use App\Helpers\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use App\Helpers\FilamentAstrotomic\TranslatableTab;
use App\Models\Admin\RealEstate\Listing;
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


class ProjectResource extends Resource {
    use Translatable;

    protected static ?string $model = Listing::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $recordTitleAttribute = 'name:en';
    protected static ?int $navigationSort = -10000000000000000;

    public static function getRecordTitle(?Model $record): Htmlable|string|null {
        return $record->translation->name ?? null;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getNavigationGroup(): ?string {
        return __('filament/RealEstate/listing.navigation_group');
    }

    public static function getNavigationLabel(): string {
        return __('filament/RealEstate/listing.project.NavigationLabel');
    }

    public static function getModelLabel(): string {
        return __('filament/RealEstate/listing.project.ModelLabel');
    }

    public static function getPluralModelLabel(): string {
        return __('filament/RealEstate/listing.project.PluralModelLabel');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function form(Form $form): Form {
        $updateSlug = EnumsRealEstateDatabaseTable::DataProjectsUpdateSlug->value;

        return $form->schema([
            Hidden::make('listing_type')->default('Project'),
            Group::make()->schema([
//                Section::make()->schema([
//                    WebpImageUpload::make('photo')
//                        ->uploadDirectory('images/quiz')
//                        ->resize(300, 300, 90)
//                        ->nullable(),
//                ]),
//                ...FormProjectOptions::make()->getColumns(),
            ])->columnSpan(1),

            Group::make()->schema([
//                TextInputSlug::make('slug')->permission($updateSlug),
//                TranslatableTabs::make('translations')
//                    ->availableLocales(['ar', 'en'])
//                    ->localeTabSchema(fn(TranslatableTab $tab) => [
//                        ...TextNameTextEditor::make()->getColumns($tab),
//                    ]),
            ])->columnSpan(2),


        ])->columns(3);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function table(Table $table): Table {
        return $table
            ->query(fn() => Listing::query()->projects())
            ->columns([
                TextColumn::make('id')->label('')->sortable()->searchable(),
                ImageColumnDef::make('photo_thumbnail'),
                ...TableProjectDefault::make()->toggleable(false)->getColumns(),
                ...TableProjectToggleable::make()->toggleable(true)->getColumns(),
                ...CreatedDates::make()->toggleable(true)->getColumns(),
            ])->filters([
                TrashedFilter::make()->label(''),
                ...TableProjectFilters::make()->printLabel(false)->getColumns(),
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

    public static function getRelations(): array {
        return [
            UnitsRelationManager::class,
        ];
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getPages(): array {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
//            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
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
                ...PrintNameWithSlug::make()->setUUID(true)->setSeo(true)->getColumns(),
                ...PrintDatesWithIaActive::make()->getColumns(),
            ]);
    }


}
