<?php

namespace App\Traits\Cash;

use App\Enums\EnumsDatabaseTable;
use App\Traits\Admin\Query\TranslatableScopes;
use Illuminate\Support\Facades\Cache;

trait CountriesDataTrait {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getCountries($IsCash = false) {
        $TableName = EnumsDatabaseTable::DataCountry->value;
        $TableTranslations = EnumsDatabaseTable::DataCountryTranslation->value;
        $ForeignKey = EnumsDatabaseTable::DataCountryForeignKey->value;
        $CashKey = EnumsDatabaseTable::DataCountryCash->value;
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
    public static function getCities($IsCash = false) {
        $TableName = EnumsDatabaseTable::DataCity->value;
        $TableTranslations = EnumsDatabaseTable::DataCityTranslation->value;
        $ForeignKey = EnumsDatabaseTable::DataCityForeignKey->value;
        $CashKey = EnumsDatabaseTable::DataCityCash->value;

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
    public static function getCitiesFilter($filterName, $filterValue) {
        $TableName = EnumsDatabaseTable::DataCity->value;
        $TableTranslations = EnumsDatabaseTable::DataCityTranslation->value;
        $ForeignKey = EnumsDatabaseTable::DataCityForeignKey->value;
        return TranslatableScopes::getTranslatedQueryFilter($TableName, $TableTranslations, $ForeignKey, $filterName, $filterValue);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getAreas($IsCash = false) {
        $TableName = EnumsDatabaseTable::DataArea->value;
        $TableTranslations = EnumsDatabaseTable::DataAreaTranslation->value;
        $ForeignKey = EnumsDatabaseTable::DataAreaForeignKey->value;
        $CashKey = EnumsDatabaseTable::DataAreaCash->value;
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
    public static function getAreasFilter($filterName, $filterValue) {
        $TableName = EnumsDatabaseTable::DataArea->value;
        $TableTranslations = EnumsDatabaseTable::DataAreaTranslation->value;
        $ForeignKey = EnumsDatabaseTable::DataAreaForeignKey->value;
        return TranslatableScopes::getTranslatedQueryFilter($TableName, $TableTranslations, $ForeignKey, $filterName, $filterValue);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function getVillages($IsCash = false) {
        $TableName = EnumsDatabaseTable::DataVillage->value;
        $TableTranslations = EnumsDatabaseTable::DataVillageTranslation->value;
        $ForeignKey = EnumsDatabaseTable::DataVillageForeignKey->value;
        $CashKey = EnumsDatabaseTable::DataVillageCash->value;
        if ($IsCash) {
            return Cache::remember($CashKey . app()->getLocale(), 3600, function () use ($TableName, $TableTranslations, $ForeignKey) {
                return TranslatableScopes::getTranslatedQuery($TableName, $TableTranslations, $ForeignKey);
            });
        } else {
            return TranslatableScopes::getTranslatedQuery($TableName, $TableTranslations, $ForeignKey);
        }
    }


}
