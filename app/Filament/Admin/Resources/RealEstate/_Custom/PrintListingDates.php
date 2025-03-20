<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;


use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;

class PrintListingDates {
    protected bool $toggleable = true;

    public static function make(): static {
        return new static();
    }


    public function getColumns(): array {
        return [
            Group::make()->schema([
                TextEntry::make('created_at')
                    ->label(__('filament/def.created_at'))
                    ->view('components.custom.text-view-entry', ['viewType' => 'dateOnly']),

                TextEntry::make('updated_at')
                    ->label(__('filament/def.updated_at'))
                    ->view('components.custom.text-view-entry', ['viewType' => 'dateOnly']),

                TextEntry::make('published_at')
                    ->label(__('filament/def.published_at'))
                    ->view('components.custom.text-view-entry', ['viewType' => 'dateOnly']),

                IconEntry::make('is_published')
                    ->label(__('filament/def.is_active'))
                    ->boolean(),

            ])->columnSpanFull()->columns(4)
        ];
    }

}
