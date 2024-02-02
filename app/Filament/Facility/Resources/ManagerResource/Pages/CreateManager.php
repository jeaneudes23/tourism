<?php

namespace App\Filament\Facility\Resources\ManagerResource\Pages;

use App\Filament\Facility\Resources\ManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateManager extends CreateRecord
{
    protected static string $resource = ManagerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'manager';
        return $data;
    }
}
