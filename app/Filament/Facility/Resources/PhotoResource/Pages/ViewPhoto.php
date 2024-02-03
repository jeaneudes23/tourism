<?php

namespace App\Filament\Facility\Resources\PhotoResource\Pages;

use App\Filament\Facility\Resources\PhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPhoto extends ViewRecord
{
    protected static string $resource = PhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
