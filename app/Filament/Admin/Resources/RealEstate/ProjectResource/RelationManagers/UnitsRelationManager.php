<?php

namespace App\Filament\Admin\Resources\RealEstate\ProjectResource\RelationManagers;

use App\Filament\Admin\Resources\RealEstate\_Custom\TableUnitFilters;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableUnitsDefault;
use App\Filament\Admin\Resources\RealEstate\_Custom\TableUnitsToggleable;
use App\FilamentCustom\Table\CreatedDates;
use App\FilamentCustom\Table\ImageColumnDef;
use App\FilamentCustom\Table\TranslationTextColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitsRelationManager extends RelationManager {
    protected static string $relationship = 'units';
    protected static ?string $title = 'الوحدات'; // هتظهر في الـ Tab العلوي في المشروع

    public function form(Form $form): Form {
        return $form
            ->schema([

            ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('Name')
            ->columns([
                TextColumn::make('id')->label('')->sortable()->searchable(),
                ImageColumnDef::make('photo_thumbnail'),
                ...TableUnitsDefault::make()->isRelationship(true)->isProject(false)->toggleable(false)->getColumns(),
                ...TableUnitsToggleable::make()->toggleable(false)->getColumns(),
                ...CreatedDates::make()->toggleable(true)->getColumns(),
            ])
            ->filters([
                ...TableUnitFilters::make()->isRelationship(true)->isProject(false)->printLabel(false)->getColumns(),
                TrashedFilter::make()->label(''),
            ], layout: FiltersLayout::AboveContent)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
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
            ]);
    }
}
