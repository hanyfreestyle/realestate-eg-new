<?php

namespace App\Enums\RealEstate;

enum EnumsRealEstateDatabaseTable :string {

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

}
