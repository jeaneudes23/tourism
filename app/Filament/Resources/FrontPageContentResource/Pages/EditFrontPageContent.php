<?php

namespace App\Filament\Resources\FrontPageContentResource\Pages;

use App\Filament\Resources\FrontPageContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFrontPageContent extends EditRecord
{
    protected static string $resource = FrontPageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
