<?php

namespace App\Filament\Admin\Resources\RealEstate\ProjectResource\RelationManagers;

use App\FilamentCustom\Table\TranslationTextColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
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

    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('Name')
            ->columns([
                TranslationTextColumn::make('name')
                    ->label(__('filament/RealEstate/listing.project_label.name'))
                    ->limit('40')
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
