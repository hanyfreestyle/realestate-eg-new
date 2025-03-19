<?php

namespace App\Enums\RealEstate;


use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumPropertyType: string {
    use EnumHasLabelOptionsTrait;

    case Apartment = 'apartment';
    case Duplex = 'duplex';
    case Studio = 'studio';
    case TownHouse = 'town-house';
    case TwinHouse = 'twin-house';
    case PentHouse = 'pent-house';
    case Villa = 'villa';
    case Office = 'office';
    case Store = 'store';
    case Chalet = 'chalet';
    case ChaletWithGarden = 'chalet-with-garden';
    case Pharmacy = 'pharmacy';
    case Clinic = 'clinic';
    case Laboratory = 'laboratory';


    public function label(): string {
        return match ($this) {
            self::Apartment => __('filament/RealEstate/listing.property_type_options.apartment'),
            self::Duplex => __('filament/RealEstate/listing.property_type_options.duplex'),
            self::Studio => __('filament/RealEstate/listing.property_type_options.studio'),
            self::TownHouse => __('filament/RealEstate/listing.property_type_options.town-house'),
            self::TwinHouse => __('filament/RealEstate/listing.property_type_options.twin-house'),
            self::PentHouse => __('filament/RealEstate/listing.property_type_options.pent-house'),
            self::Villa => __('filament/RealEstate/listing.property_type_options.villa'),
            self::Office => __('filament/RealEstate/listing.property_type_options.office'),
            self::Store => __('filament/RealEstate/listing.property_type_options.store'),
            self::Chalet => __('filament/RealEstate/listing.property_type_options.chalet'),
            self::ChaletWithGarden => __('filament/RealEstate/listing.property_type_options.chalet-with-garden'),
            self::Pharmacy => __('filament/RealEstate/listing.property_type_options.pharmacy'),
            self::Clinic => __('filament/RealEstate/listing.property_type_options.clinic'),
            self::Laboratory => __('filament/RealEstate/listing.property_type_options.laboratory'),
        };
    }
}

