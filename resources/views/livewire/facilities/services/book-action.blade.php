<?php

use App\Filament\Facility\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Service;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Set;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Livewire\Volt\Component;
use Illuminate\Support\Str;

new class extends Component implements HasForms, HasActions
{
    //
    use InteractsWithForms;
    use InteractsWithActions;

    public Service $service;

    public function createAction()
    {
        return CreateAction::make()
            ->icon('heroicon-o-bolt')
            ->color(Color::Green)
            ->label($this->service->custom_text)
            ->model(Booking::class)
            ->createAnother(false)
            ->form([
                Group::make()
                    ->columnSpanFull()
                    ->schema([
                        Group::make()
                            ->columnSpan(2)
                            ->columns(3)
                            ->schema([
                                DatePicker::make('booking_date')
                                    ->minDate(now()->addDays(2))
                                    ->closeOnDateSelection()
                                    ->native(0)
                                    ->required(),
                                TextInput::make('quantity')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->integer()
                                    ->minValue(1)
                                    ->label(Str::plural($this->service->unit))
                                    ->afterStateUpdated(function (Set $set, $state): void {
                                        $total = $this->service->unit_price * $state;
                                        $set('total_price', $total);
                                    }),
                                TextInput::make('total_price')
                                    ->suffix('RWF')
                                    ->required()
                                    ->readOnly(),
                            ]),

                        Textarea::make('customer_message'),
                    ]),
            ])
            ->mutateFormDataUsing(function (array $data) {
                $data['customer_id'] = auth()->user()->id;
                $data['service_id'] = $this->service->id;
                $data['facility_id'] = $this->service->facility->id;
                return $data;
            })
            ->after(function (Booking $record){
              Notification::make()
              ->title('New Booking')
              ->actions([
                Action::make('view')
                  ->icon('heroicon-o-eye')
                  ->url(BookingResource::getUrl('view', ['record' => $record->id] , true ,'facility' , $record->facility))
                  ->button()
              ])
              ->sendToDatabase($record->facility->managers);

            });
    }
}; ?>

<div>
    {{ $this->createAction }}

    <x-filament-actions::modals />
</div>