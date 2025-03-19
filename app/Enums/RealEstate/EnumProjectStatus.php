<?php

namespace App\Enums\RealEstate;


enum EnumProjectStatus: string {
    case UnderConstruction = 'under-construction';
    case Completed = 'completed';


    public function label(): string {
        return match ($this) {
            self::UnderConstruction => __('filament/RealEstate/listing.status_options.under-construction'),
            self::Completed => __('filament/RealEstate/listing.status_options.completed'),

        };
    }
}

