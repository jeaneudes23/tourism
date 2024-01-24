<?php

namespace App\Filament\Facility\Resources;

use App\Filament\Facility\Resources\ServiceResource\Pages;
use App\Filament\Facility\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
  protected static ?string $model = Service::class;

  protected static ?string $navigationIcon = 'heroicon-o-tag';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Group::make()
          ->columnSpanFull()
          ->schema([
            Wizard::make()
              ->schema([
                Step::make('Service Details')
                  ->schema([
                    Group::make()
                      ->columnSpanFull()
                      ->columns(3)
                      ->schema([
                        TextInput::make('name')
                          ->required()
                          ->maxLength(255),
                        TagsInput::make('tags')
                          ->separator(','),
                        Toggle::make('is_bookable')
                          ->live()
                      ]),
                    Section::make('Pricing')
                      ->hidden(fn (Get $get) => !$get('is_bookable'))
                      ->columnSpanFull()
                      ->compact()
                      ->collapsible()
                      ->columns(3)
                      ->schema([
                        TextInput::make('custom_text')
                          ->default('book'),
                        TextInput::make('unit_price')
                          ->required(fn (Get $get) => $get('is_bookable'))
                          ->numeric(),
                        TextInput::make('unit')
                          ->required(fn (Get $get) => $get('is_bookable'))
                          ->maxLength(255),
                      ]),
                    Section::make()
                      ->collapsible()
                      ->compact()
                      ->schema([

                        RichEditor::make('description'),
                      ]),


                  ]),
                Step::make('Gallery')
                  ->schema([
                    FileUpload::make('image')
                      ->image(),
                    TextInput::make('attachments')
                      ->maxLength(255),
                  ])
              ])
          ])


      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->searchable(),
        TextColumn::make('tags')
          ->searchable(),
        IconColumn::make('is_bookable')
        ->boolean(),
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
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
      'index' => Pages\ListServices::route('/'),
      'create' => Pages\CreateService::route('/create'),
      'view' => Pages\ViewService::route('/{record}'),
      'edit' => Pages\EditService::route('/{record}/edit'),
    ];
  }
}
