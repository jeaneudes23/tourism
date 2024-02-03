<?php

namespace App\Filament\Facility\Resources;

use App\Filament\Facility\Resources\BookingResource\Pages;
use App\Filament\Facility\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Livewire\Volt\title;

class BookingResource extends Resource
{
  protected static ?string $model = Booking::class;

  protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

  public static function getNavigationBadge(): ?string
  {
      return Filament::getTenant()->bookings->count();
  }

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        //
        Group::make()
          ->columnSpanFull()
          ->schema([
            Section::make('')
              ->compact()
              ->collapsible()
              ->schema([
                Group::make()
                  ->columnSpanFull()
                  ->columns(2)
                  ->schema([
                    Select::make('service_id')
                      ->relationship(
                        name: 'service',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant())->where('is_bookable', 1)
                      )
                      ->live()
                      ->afterStateUpdated(function (Set $set): void {
                        $set('quantity', null);
                        $set('total_price', null);
                      })
                      ->required()
                      ->preload()
                      ->searchable(),
                  Select::make('customer_id')
                     ->relationship('customer','name')
                     ->preload()
                     ->searchable()

                  ]),
                  Group::make()
                  ->hidden(fn (Get $get) => !filled($get('service_id')))
                  ->columnSpan(2)
                  ->columns(2)
                  ->schema([
                    TextInput::make('quantity')
                      ->required()
                      ->live(onBlur: true)
                      ->integer()
                      ->minValue(1)
                      ->label(function (Get $get): string {
                        $unit = Service::where('id', $get('service_id'))->get()->value('unit');
                        $plural = Str::plural(Str::upper($unit));
                        return $plural;
                      })
                      ->afterStateUpdated(function (Get $get, Set $set, $state): void {
                        $unit_price = Service::where('id', $get('service_id'))->get()->value('unit_price');
                        $total = $unit_price * $state;
                        $set('total_price', $total);
                      }),
                    TextInput::make('total_price')
                      ->required()
                      ->readOnly(),
                ]),
                Group::make()
                  ->columnSpanFull()
                  ->columns(2)
                  ->schema([
                    TextInput::make('booking_code')
                      ->unique(Booking::class, 'booking_code', ignoreRecord: true),
                    Select::make('status')
                      ->options([
                        'pending' => 'Pending',
                        'cancelled' => 'Cancelled',
                        'confirmed' => 'Confirmed',
                      ])
                      ->default('pending'),
                  ]),
                Group::make()
                  ->columnSpanFull()
                  ->columns(2)
                  ->schema([
                    DatePicker::make('booking_date'),
                    DatePicker::make('confirm_date'),
                    DatePicker::make('cancel_date'),
                  ]),
              ]),
            Section::make('Notes')
              ->compact()
              ->collapsible()
              ->schema([
                Textarea::make('customer_message'),
                Textarea::make('manager_message'),
              ])

          ]),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        //
        TextColumn::make('service.name'),
        TextColumn::make('customer.name'),
        TextColumn::make('status')
          ->badge()
          ->color(fn (string $state): string => match ($state) {
            'pending' => 'gray',
            'confirmed' => 'success',
            'cancelled' => 'danger',
          }),
        TextColumn::make('created_at')
          ->date(),

      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
        Action::make('Accept')
          ->successNotificationTitle('Booking Cancelled')
          ->requiresConfirmation()
          ->action(function (Booking $record, array $data){
            $record->update([
            'status' => 'confirmed',
            'confirm_date' => Carbon::today(),
            'manager_message' => $data['manager_message']
            ]);
            if (!Filament::getTenant()->customers()->where('customer_id', $record->customer_id)->exists())
              Filament::getTenant()->customers()->attach($record->customer_id);
          })
          ->form([
            Textarea::make('manager_message')
          ])
          ->color('success')
          ->hidden(fn (Model $record): bool => $record->status == 'confirmed'),
        Action::make('Cancel')
          ->successNotificationTitle('Booking Cancelled')
          ->requiresConfirmation()
          ->action(fn (Booking $record , array $data) => $record->update([
            'status' => 'cancelled',
            'cancel_date' => Carbon::today(),
            'manager_message' => $data['manager_message']
          ]))
          ->form([
            Textarea::make('manager_message')
          ])
          ->color('danger')
          ->hidden(fn (Model $record): bool => $record->status == 'cancelled'),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListBookings::route('/'),
      'create' => Pages\CreateBooking::route('/create'),
      'view' => Pages\ViewBooking::route('/{record}'),
      'edit' => Pages\EditBooking::route('/{record}/edit'),
    ];
  }
}
