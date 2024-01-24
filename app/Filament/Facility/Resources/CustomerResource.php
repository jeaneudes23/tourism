<?php

namespace App\Filament\Facility\Resources;

use App\Filament\Facility\Resources\CustomerResource\Pages;
use App\Filament\Facility\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
  protected static ?string $model = Customer::class;

  protected static ?string $navigationIcon = 'heroicon-o-user-group';
  protected static ?string $tenantOwnershipRelationshipName = 'facilities';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        //
        Section::make()
          ->columns(2)
          ->schema([
            TextInput::make('name')
              ->required(),
            TextInput::make('email')
              ->required(),
            TextInput::make('phone')
              ->tel()
              ->required(),
            TextInput::make('token')
              ->required(),
            Select::make('id_type')
              ->options([
                'national_id' => 'National id',
                'passport' => 'passport',
              ])
              ->required()
              ->default('national_id'),
            TextInput::make('id_number')
              ->required()
          ])

      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        //
        TextColumn::make('name'),
        TextColumn::make('email'),
        TextColumn::make('phone'),
        TextColumn::make('id_type'),
        TextColumn::make('id_number'),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
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
      'index' => Pages\ListCustomers::route('/'),
      'create' => Pages\CreateCustomer::route('/create'),
      'edit' => Pages\EditCustomer::route('/{record}/edit'),
    ];
  }
}
