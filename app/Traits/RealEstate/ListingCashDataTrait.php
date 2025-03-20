<?php

namespace App\Traits\RealEstate;

use App\Enums\RealEstate\EnumsRealEstateDatabaseTable;
use App\Traits\Admin\Query\TranslatableScopes;
use Illuminate\Support\Facades\Cache;

trait ListingCashDataTrait {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getDataProject($IsCash = false) {
        $TableName = EnumsRealEstateDatabaseTable::DataProjects->value;
        $TableTranslations = EnumsRealEstateDatabaseTable::DataProjectsTranslation->value;
        $ForeignKey = EnumsRealEstateDatabaseTable::DataProjectsForeignKey->value;
        $CashKey = EnumsRealEstateDatabaseTable::DataProjectsCash->value;
        if ($IsCash) {
            return Cache::remember($CashKey . app()->getLocale(), 3600, function () use ($TableName, $TableTranslations, $ForeignKey) {
                return TranslatableScopes::getTranslatedQueryFilter($TableName, $TableTranslations, $ForeignKey, 'listing_type', "Project");
            });
        } else {
            return TranslatableScopes::getTranslatedQueryFilter($TableName, $TableTranslations, $ForeignKey, 'listing_type', "Project");
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getDataDeveloper($IsCash = false) {
        $TableName = EnumsRealEstateDatabaseTable::DataDevelopers->value;
        $TableTranslations = EnumsRealEstateDatabaseTable::DataDevelopersTranslation->value;
        $ForeignKey = EnumsRealEstateDatabaseTable::DataDevelopersForeignKey->value;
        $CashKey = EnumsRealEstateDatabaseTable::DataDevelopersCash->value;
        if ($IsCash) {
            return Cache::remember($CashKey . app()->getLocale(), 3600, function () use ($TableName, $TableTranslations, $ForeignKey) {
                return TranslatableScopes::getTranslatedQuery($TableName, $TableTranslations, $ForeignKey);
            });
        } else {
            return TranslatableScopes::getTranslatedQuery($TableName, $TableTranslations, $ForeignKey);
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getDataLocation($IsCash = false) {
        $TableName = EnumsRealEstateDatabaseTable::DataLocation->value;
        $TableTranslations = EnumsRealEstateDatabaseTable::DataLocationTranslation->value;
        $ForeignKey = EnumsRealEstateDatabaseTable::DataLocationForeignKey->value;
        $CashKey = EnumsRealEstateDatabaseTable::DataLocationCash->value;
        if ($IsCash) {
            return Cache::remember($CashKey . app()->getLocale(), 3600, function () use ($TableName, $TableTranslations, $ForeignKey) {
                return TranslatableScopes::getTranslatedQuery($TableName, $TableTranslations, $ForeignKey);
            });
        } else {
            return TranslatableScopes::getTranslatedQuery($TableName, $TableTranslations, $ForeignKey);
        }
    }

}
