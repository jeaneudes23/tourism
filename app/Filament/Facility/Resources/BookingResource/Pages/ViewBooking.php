<?php

namespace App\Filament\Facility\Resources\BookingResource\Pages;

use App\Filament\Facility\Resources\BookingResource;
use App\Models\Booking;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Actions\Action as ActionsAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewBooking extends ViewRecord
{
  protected static string $resource = BookingResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\EditAction::make(),
      Action::make('Accept')
        ->successNotificationTitle('Booking Cancelled')
        ->requiresConfirmation()
        ->action(function (Booking $record, array $data) {
          $record->update([
            'status' => 'confirmed',
            'confirm_date' => Carbon::now(),
            'manager_message' => $data['manager_message']
          ]);
          if (!Filament::getTenant()->customers()->where('customer_id', $record->customer_id)->exists())
            Filament::getTenant()->customers()->attach($record->customer_id);
        })
        ->form([
          Textarea::make('manager_message')
        ])
        ->color('success')
        ->hidden(fn(Model $record): bool => $record->status == 'confirmed')
        ->after(function (Booking $record) {
          Notification::make()
          ->title('Booking Update')
          ->body($record->manager_message)
          ->sendToDatabase($record->customer);
        }),
      Action::make('Cancel')
        ->successNotificationTitle('Booking Cancelled')
        ->requiresConfirmation()
        ->action(fn(Booking $record, array $data) => $record->update([
          'status' => 'cancelled',
          'cancel_date' => Carbon::now(),
          'manager_message' => $data['manager_message']
        ]))
        ->form([
          Textarea::make('manager_message')
        ])
        ->color('danger')
        ->hidden(fn(Model $record): bool => $record->status == 'cancelled'),
      Action::make('Notify Customer')
      ->successNotificationTitle('Booking Cancelled')
      ->requiresConfirmation()
      ->action(fn(Booking $record, array $data) => $record->update([
        'manager_message' => $data['manager_message']
      ]))
      ->form([
        Textarea::make('manager_message')
      ])
      ->color('warning')
      ->after(function (Booking $record) {
        Notification::make()
        ->title('Booking Update')
        ->actions([
          ActionsAction::make('View')
          ->url(fn () => route('myspace.index'))
        ])
        ->body($record->manager_message)
        ->sendToDatabase($record->customer);
      }),
    ];
  }
}
