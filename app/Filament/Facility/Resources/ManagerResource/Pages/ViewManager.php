<?php

namespace App\Filament\Facility\Resources\ManagerResource\Pages;

use App\Filament\Facility\Resources\ManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewManager extends ViewRecord
{
    protected static string $resource = ManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
