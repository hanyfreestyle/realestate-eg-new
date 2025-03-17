<?php

namespace App\Enums\RealEstate;

enum EnumsRealEstateDatabaseTable :string {

    case DataDevelopers  = 'developers' ;
    case DataDevelopersCash  = 'DataDevelopers_CashList_' ;
    case DataDevelopersTranslation  = 'developer_translations' ;
    case DataDevelopersForeignKey  = 'country_id' ;
    case DataDevelopersUpdateSlug = 'DataDevelopersUpdateSlug';


}
