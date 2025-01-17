<?php

namespace App\Filament\Facility\Resources\BookingResource\Pages;

use App\Filament\Facility\Resources\BookingResource;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingUpdate;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
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
      Action::make('Respond')
        ->successNotificationTitle('Booking Cancelled')
        ->action(fn(Booking $record, array $data) => $record->update($data))
        ->form([
          Select::make('status')
            ->options([
              'pending' => 'Pending',
              'cancelled' => 'Cancelled',
              'confirmed' => 'Confirmed',
            ])
            ->native(0)
            ->default('pending'),
          DateTimePicker::make('booking_date')
          ->required()
          ->default($this->getRecord()->booking_date),
          Textarea::make('manager_message')
        ])
        ->color('success')
        ->after(function (Booking $record) {
          /** @var User $customer */
          $booking = $this->getRecord();
          $customer = User::find($booking->customer_id);
          $this->refreshFormData(['status','booking_date']);
          Notification::make()
          ->success()
          ->title('Feedback sent to customer')
          ->send();
          if ($customer) {
            Notification::make()
              ->title('Booking Update')
              ->actions([
                ActionsAction::make('View')
                  ->url(fn() => route('myspace.index'))
              ])
              ->body($booking->manager_message)
              ->sendToDatabase($customer);
            
            $customer->notify(new BookingUpdate($booking));
          }
        }),
    ];
  }
}
