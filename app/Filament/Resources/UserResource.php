<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
  protected static ?string $model = User::class;


  protected static ?string $navigationIcon = 'heroicon-o-shield-check';

  protected static bool $shouldRegisterNavigation = false;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()
          ->columns(2)
          ->schema([
            TextInput::make('name')
              ->unique(User::class, 'name', ignoreRecord: true)
              ->required()
              ->maxLength(255),
            TextInput::make('email')
              ->unique(User::class, 'email', ignoreRecord: true)
              ->email()
              ->required()
              ->maxLength(255),
            TextInput::make('phone')
              ->required()
              ->maxLength(255),
            TextInput::make('password')
              ->password()
              ->dehydrateStateUsing(fn($state) => Hash::make($state))
              ->dehydrated(fn($state) => filled($state))
              ->required(fn(string $context): bool => $context === 'create'),
            Toggle::make('is_active')
            ->default(1)
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
        ToggleColumn::make('is_active'),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
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
      'index' => Pages\ListUsers::route('/'),
      'create' => Pages\CreateUser::route('/create'),
      'view' => Pages\ViewUser::route('/{record}'),
      'edit' => Pages\EditUser::route('/{record}/edit'),
    ];
  }
}
