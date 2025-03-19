<?php

namespace App\Filament\Admin\Resources\RealEstate\ProjectResource\Pages;

use App\Filament\Admin\Resources\RealEstate\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListProjects extends ListRecords{
    protected static string $resource = ProjectResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getHeaderActions(): array{
        return [
            Actions\CreateAction::make(),
        ];
    }

 #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
 #||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
     public function getTabs(): array {
         $tabs = [
             'Active' => [
                 'label' => __('filament/def.tab_list.active'),
                 'icon' => 'heroicon-o-paper-clip',
                 'conditions' => fn(Builder $query) => $query->projects()->where('is_published', 1),
                 'badgeColor' => 'success',
             ],
             'Pending' => [
                 'label' => __('filament/def.tab_list.pending'),
                 'icon' => 'heroicon-o-lock-closed',
                 'conditions' => fn(Builder $query) => $query->projects()->where('is_published', 0),
                 'badgeColor' => 'warning',
             ],
             'All' => [
                 'label' => __('filament/def.tab_list.all'),
                 'badge' => static::getModel()::query()->projects()->count(),
                 'conditions' => fn(Builder $query) => $query->projects()->where('id', '>',0),
             ],
         ];

         return array_map(fn($key, $tab) => Tab::make()
             ->label($tab['label'])
             ->icon($tab['icon'] ?? null)
             ->modifyQueryUsing($tab['conditions'] ?? fn($q) => $q)
             ->badge($tab['badge'] ?? static::getModel()::query()->where(fn($q) => ($tab['conditions'] ?? fn($q) => $q)($q))->count())
             ->badgeColor($tab['badgeColor'] ?? null), array_keys($tabs), $tabs);
     }
}
