<?php

use Livewire\Volt\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Service;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;

new class extends Component implements HasForms
{
    //
    use InteractsWithForms;

    public Service $service;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->columnSpanFull()
                    ->schema([
                        Group::make()
                            ->columnSpan(2)
                            ->columns(3)
                            ->schema([
                                DatePicker::make('booking_date')
                                ->minDate(today())
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
            ->statePath('data');
    }

    public function book(): void
    {
        $data = ($this->form->getState());
        $data['customer_id'] = auth()->user()->id;
        $data['facility_id'] = $this->service->facility->id;
        $this->service->bookings()->create($data);

        session()->flash('message', 'Booking Successfull');

    }
}; ?>

<div>
    <form wire:submit='book'>
        {{ $this->form }}

        <button wire:loading.disabled class="mt-5 text-white w-24 flex justify-center items-center h-10 bg-green-600 font-medium tracking-wide rounded-md">
            <span wire:loading.remove>{{$service->custom_text}}</span>
            <div class="flex justify-center">
                <div wire:loading.flex class="w-6 aspect-square animate-spin rounded-full border-4 border-white border-l-transparent"></div>
            </div>
        </button>
    </form>
</div>