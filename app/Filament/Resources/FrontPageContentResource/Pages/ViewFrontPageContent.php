<?php

namespace App\Filament\Resources\FrontPageContentResource\Pages;

use App\Filament\Resources\FrontPageContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFrontPageContent extends ViewRecord
{
    protected static string $resource = FrontPageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
