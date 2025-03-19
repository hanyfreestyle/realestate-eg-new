<?php

namespace App\Enums\RealEstate;


use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumPropertyView: string {
    use EnumHasLabelOptionsTrait;

    case MainStreet = 'main-street';
    case SeaView = 'seaview';
    case LakeView = 'lakeview';
    case NileView = 'nileview';


    public function label(): string {
        return match ($this) {
            self::MainStreet => __('filament/RealEstate/listing.view_options.main-street'),
            self::SeaView => __('filament/RealEstate/listing.view_options.seaview'),
            self::LakeView => __('filament/RealEstate/listing.view_options.lakeview'),
            self::NileView => __('filament/RealEstate/listing.view_options.nileview'),
        };
    }
}

