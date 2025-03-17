<?php

namespace App\Enums\RealEstate;

enum EnumsRealEstateDatabaseTable :string {

    case DataDevelopers  = 'developer' ;
    case DataDevelopersCash  = 'DataDevelopers_CashList_' ;
    case DataDevelopersTranslation  = 'developer_lang' ;
    case DataDevelopersForeignKey  = 'developer_id' ;
    case DataDevelopersUpdateSlug = 'DataDevelopersUpdateSlug';


}
