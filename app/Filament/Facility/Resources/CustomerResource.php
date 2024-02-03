<?php

namespace App\Filament\Facility\Resources;

use App\Filament\Facility\Resources\CustomerResource\Pages;
use App\Filament\Facility\Resources\CustomerResource\RelationManagers;
use App\Filament\Resources\UserResource;
use App\Models\Customer;
use Filament\Facades\Filament;
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
  
  public static function getNavigationBadge(): ?string
  {
      return Filament::getTenant()->customers->count();
  }

  protected static ?string $navigationIcon = 'heroicon-o-user-group';
  protected static ?string $tenantOwnershipRelationshipName = 'facilities';

  public static function form(Form $form): Form
  {
    return UserResource::form($form);
  }

  public static function table(Table $table): Table
  {
    return UserResource::table($table);
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
