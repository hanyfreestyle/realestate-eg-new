<?php

namespace App\Filament\Admin\Resources\RealEstate\_Custom;

use App\Enums\RealEstate\EnumPropertyType;
use App\Enums\RealEstate\EnumPropertyView;
use App\Traits\Admin\Helper\FilterLabelHelperTrait;
use App\Traits\RealEstate\ListingCashDataTrait;
use Filament\Tables\Filters\SelectFilter;

class TableUnitFilters {
    use FilterLabelHelperTrait;

    protected bool $printLabel = true;
    protected bool $isProject = true; // القيمة الافتراضية

    public static function make(): static {
        return new static();
    }

    public function printLabel(bool $value = true): static {
        $this->printLabel = $value;
        return $this;
    }

    public function isProject(bool $value = true): static {
        $this->isProject = $value;
        return $this;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public function getColumns(): array {
        $filters = [];

        if ($this->isProject) {
            $filters[] = self::applyLabelOrPlaceholder(
                SelectFilter::make('parent_id')
                    ->options(ListingCashDataTrait::getDataProject(true))
                    ->multiple()
                    ->searchable()
                    ->columnSpanFull()
                    ->preload(),
                'filament/RealEstate/listing.project_label.parent_id',
                $this->printLabel
            );
        }

        // باقي الفلاتر
        $filters[] = self::applyLabelOrPlaceholder(
            SelectFilter::make('property_type')
                ->options(EnumPropertyType::options())
                ->multiple()
                ->searchable()
                ->preload(),
            'filament/RealEstate/listing.project_label.property_type',
            $this->printLabel
        );

        $filters[] = self::applyLabelOrPlaceholder(
            SelectFilter::make('view')
                ->options(EnumPropertyView::options())
                ->multiple()
                ->searchable()
                ->preload(),
            'filament/RealEstate/listing.project_label.view',
            $this->printLabel
        );

        $filters[] = self::applyLabelOrPlaceholder(
            SelectFilter::make('developer_id')
                ->options(ListingCashDataTrait::getDataDeveloper(true))
                ->multiple()
                ->searchable()
                ->preload(),
            'filament/RealEstate/listing.project_label.developer_id',
            $this->printLabel
        );

        $filters[] = self::applyLabelOrPlaceholder(
            SelectFilter::make('location_id')
                ->options(ListingCashDataTrait::getDataLocation(true))
                ->multiple()
                ->searchable()
                ->preload(),
            'filament/RealEstate/listing.project_label.location_id',
            $this->printLabel
        );

        return $filters;

    }

}
