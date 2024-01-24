<?php

namespace App\Filament\Facility\Resources\UserResource\Pages;

use App\Filament\Facility\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'manager';
        return $data;
    }
}
