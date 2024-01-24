<?php

namespace App\Filament\Resources\FrontPageContentResource\Pages;

use App\Filament\Resources\FrontPageContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFrontPageContents extends ListRecords
{
    protected static string $resource = FrontPageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
