<?php

namespace App\Filament\Facility\Resources\PhotoResource\Pages;

use App\Filament\Facility\Resources\PhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhoto extends EditRecord
{
    protected static string $resource = PhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
