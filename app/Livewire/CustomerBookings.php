<?php

namespace App\Livewire;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class CustomerBookings extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::where('customer_id', auth()->user()->id)
            )
            ->columns([
              TextColumn::make('facility.name'),
              TextColumn::make('service.name')
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
                ->datetime(),
              TextColumn::make('created_at')
                ->sortable()
                ->datetime(),
              TextColumn::make('updated_at')
                ->sortable()
                ->datetime(),
            ])
            ->defaultSort('updated_at','desc')
            ->actions([
              Action::make('Cancel')
              ->color('danger') 
              ->requiresConfirmation()
              ->action(fn (Booking $record) => $record->delete())
              ->icon('heroicon-o-x-mark')
              ->visible(fn (Booking $record): bool => $record->status !== 'confirmed')
            ]);
    }
}
