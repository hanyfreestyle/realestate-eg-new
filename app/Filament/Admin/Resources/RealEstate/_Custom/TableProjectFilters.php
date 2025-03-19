<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;

use App\Enums\RealEstate\EnumProjectStatus;
use App\Enums\RealEstate\EnumProjectType;
use App\Traits\Admin\Helper\FilterLabelHelperTrait;
use App\Traits\RealEstate\ListingCashDataTrait;
use Filament\Tables\Filters\SelectFilter;

class TableProjectFilters {
    use FilterLabelHelperTrait;

    protected bool $printLabel = true;

    public static function make(): static {
        return new static();
    }

    public function printLabel(bool $value = true): static {
        $this->printLabel = $value;
        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public function getColumns(): array {

        return [
            self::applyLabelOrPlaceholder(
                SelectFilter::make('project_type')
                    ->options(EnumProjectType::options())
                    ->multiple()
                    ->searchable()
                    ->preload(),
                'filament/RealEstate/listing.project_label.project_type',
                $this->printLabel
            ),
            self::applyLabelOrPlaceholder(
                SelectFilter::make('status')
                    ->options(EnumProjectStatus::options())
                    ->multiple()
                    ->searchable()
                    ->preload(),
                'filament/RealEstate/listing.project_label.status',
                $this->printLabel
            ),

            self::applyLabelOrPlaceholder(
                SelectFilter::make('developer_id')
                    ->options(ListingCashDataTrait::getDataDeveloper(true))
                    ->multiple()
                    ->searchable()
                    ->preload(),
                'filament/RealEstate/listing.project_label.developer_id',
                $this->printLabel
            ),

            self::applyLabelOrPlaceholder(
                SelectFilter::make('location_id')
                    ->options(ListingCashDataTrait::getDataLocation(true))
                    ->multiple()
                    ->searchable()
                    ->preload(),
                'filament/RealEstate/listing.project_label.location_id',
                $this->printLabel
            ),


        ];
    }

}
