<?php

namespace App\Filament\Facility\Widgets;

use App\Filament\Facility\Resources\BookingResource;
use App\Models\Booking;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBookings extends BaseWidget
{
  protected int | string | array $columnSpan = 'full';

  public function table(Table $table): Table
  {
    return $table
      ->query(
        Booking::where('facility_id', Filament::getTenant()->id)
      )
      ->recordUrl(fn (Booking $record) => BookingResource::getUrl('view', ['record' => $record->id]))
      ->columns([
        // ...
        TextColumn::make('service.name')
        ->searchable()
        ->sortable(),
        TextColumn::make('customer.name')
        ->searchable()
        ->sortable(),
        TextColumn::make('status')
          ->badge()
          ->color(fn (string $state): string => match ($state) {
            'pending' => 'gray',
            'confirmed' => 'success',
            'cancelled' => 'danger',
          }),
        TextColumn::make('booking_date')
          ->sortable()
          ->date(),
        TextColumn::make('created_at')
          ->sortable()
          ->date(),
      ]);
  }
}
