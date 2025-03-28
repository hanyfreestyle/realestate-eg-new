<?php

namespace App\Enums\RealEstate;


use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumProjectType: string {
    use EnumHasLabelOptionsTrait;

    case Residential = 'residential';
    case Vacation = 'vacation';
    case Commercial = 'commercial';
    case Medical = 'medical';

    public function label(): string {
        return match ($this) {
            self::Residential => __('filament/RealEstate/listing.project_type_options.residential'),
            self::Vacation => __('filament/RealEstate/listing.project_type_options.vacation'),
            self::Commercial => __('filament/RealEstate/listing.project_type_options.commercial'),
            self::Medical => __('filament/RealEstate/listing.project_type_options.medical'),
        };
    }
}
