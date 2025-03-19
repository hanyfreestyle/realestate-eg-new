<?php

namespace App\Enums\RealEstate;

use App\Traits\Admin\Helper\EnumHasLabelOptionsTrait;

enum EnumsRealEstateDatabaseTable :string {
    use EnumHasLabelOptionsTrait;

    case DataDevelopers  = 'developer' ;
    case DataDevelopersCash  = 'DataDevelopers_CashList_' ;
    case DataDevelopersTranslation  = 'developer_lang' ;
    case DataDevelopersForeignKey  = 'developer_id' ;
    case DataDevelopersUpdateSlug = 'update_slug_real::estate::developer';

    case DataAmenities  = 'amenity' ;
    case DataAmenitiesCash  = 'DataAmenities_CashList_' ;
    case DataAmenitiesTranslation  = 'amenity_lang' ;
    case DataAmenitiesForeignKey  = 'amenity_id' ;
    case DataAmenitiesUpdateSlug = 'update_slug_real::estate::amenity';


    case DataLocation  = 'location' ;
    case DataLocationCash  = 'DataLocation_CashList_' ;
    case DataLocationTranslation  = 'location_lang' ;
    case DataLocationForeignKey  = 'location_id' ;
    case DataLocationUpdateSlug = 'update_slug_real::estate::location';

    case DataProjects  = 'listings' ;
    case DataProjectsCash  = 'DataProjects_CashList_' ;
    case DataProjectsTranslation  = 'listing_translations' ;
    case DataProjectsForeignKey  = 'listing_id' ;
    case DataProjectsUpdateSlug = 'update_slug_real::estate::project';
    case DataProjectsUnitType = 'project';

}
