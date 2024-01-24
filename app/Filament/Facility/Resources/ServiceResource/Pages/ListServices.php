<?php

namespace App\Filament\Facility\Resources\ServiceResource\Pages;

use App\Filament\Facility\Resources\ServiceResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
            ->badge(Filament::getTenant()->services->count()),
            'Bookable' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_bookable', 1))
            ->badge(Filament::getTenant()->services->where('is_bookable', 1)->count()),
            'Not Bookable' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_bookable', 0))
            ->badge(Filament::getTenant()->services->where('is_bookable', 0)->count()),
        ];
    }
}
