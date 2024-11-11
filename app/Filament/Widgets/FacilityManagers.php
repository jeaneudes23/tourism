<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\FacilityResource;
use App\Models\Facility;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class FacilityManagers extends BaseWidget
{
  public array | int | string $columnSpan = 'full';
  public function table(Table $table): Table
  {
    return $table
      ->query(
        // ...
        Facility::query()->with(['managers','categories'])
      )
      ->recordUrl(fn (Facility $record) => FacilityResource::getUrl('view', ['record' => $record->id]))
      ->columns([
        // ...
        ImageColumn::make('image')
        ->circular(),
        TextColumn::make('name'),
        TextColumn::make('categories.name')
        ->badge(),
        TextColumn::make('managers.name'),
        ToggleColumn::make('is_active')
      ]);
  }
}
