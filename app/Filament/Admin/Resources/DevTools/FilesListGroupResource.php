<?php

namespace App\Filament\Admin\Resources\DevTools;

use App\Filament\Admin\Resources\DevTools\FilesListGroupResource\Pages;

use App\Models\Admin\DevTools\FilesListGroup;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class FilesListGroupResource extends Resource {
    protected static ?string $model = FilesListGroup::class;
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    // protected static ?string $navigationGroup = 'admin-core';
    protected static ?int $navigationSort = -10;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getNavigationGroup(): ?string {
        return __('filament/core/fileList.navigation_group');
    }


    public static function getNavigationLabel(): string {
        return __('filament/folderName/fileName.category.NavigationLabel');
    }

    public static function getModelLabel(): string {
        return __('filament/folderName/fileName.category.ModelLabel');
    }

    public static function getPluralModelLabel(): string {
        return __('filament/folderName/fileName.category.PluralModelLabel');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function form(Form $form): Form {
        return $form
            ->schema([
                Group::make()->schema([

                    TextInput::make('name')
                        ->label(__('filament/def.tableHeader.name'))
                        ->extraAttributes(['dir' => 'ltr', 'style' => 'text-align: left',])
                        ->maxLength(200)
                        ->columnSpanFull()
                        ->required(),


                ])->columnSpanFull()->columns(4),
            ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function table(Table $table): Table {
        return $table
            ->columns([
                TextInputColumn::make('name'),
                ToggleColumn::make('is_active')
                    ->label('Active'),
            ])
            ->filters([


            ])
            ->persistFiltersInSession()
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('position')
            ->defaultSort('position');
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
            'index' => Pages\ListFilesListGroups::route('/'),
//            'create' => Pages\CreateFilesListGroup::route('/create'),
            'view' => Pages\ViewFilesListGroup::route('/{record}'),
//            'edit' => Pages\EditFilesListGroup::route('/{record}/edit'),
        ];
    }


    public static function getTableRecordUrl($record): ?string {
        return static::getUrl('edit', ['record' => $record->getKey()]);
    }


}
