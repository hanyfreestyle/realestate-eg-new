<?php

namespace App\FilamentCustom\Table;

use Filament\Tables\Columns\ImageColumn;


class ImageColumnDef extends ImageColumn {

    protected function setUp(): void {
        parent::setUp();
        $this
            ->label('')
            ->width(40)
            ->height(40)
            ->defaultImageUrl(asset('assets/client/_def/no-photo.png'));
    }
}
