<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages\Facilities;
use App\Filament\Resources\FacilityResource\Pages;
use App\Filament\Resources\FacilityResource\Pages\EditFacility;
use App\Filament\Resources\FacilityResource\Pages\Managers;
use App\Filament\Resources\FacilityResource\Pages\Services;
use App\Filament\Resources\FacilityResource\Pages\ViewFacility;
use App\Filament\Resources\FacilityResource\RelationManagers;
use App\Models\Facility;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Collection';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getRecordSubNavigation(Page $page): array
    {
      return $page->generateNavigationItems([
        EditFacility::class,
        ViewFacility::class,
        Managers::class,
        Services::class,
      ]);
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Group::make()
            ->columnSpanFull()
            ->schema([
            Wizard::make()
              ->schema([
                Step::make('Front Page Content')
                ->icon('heroicon-o-queue-list')
                ->schema([
                  Group::make()
                  ->columnSpanFull()
                  ->columns(2)
                  ->schema([
                    Select::make('category_id')
                    ->relationship('category','name')
                    ->searchable()
                    ->preload()
                    ->hiddenOn(Facilities::class),
                    TextInput::make('name')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                    Group::make()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                      Textarea::make('title')
                      ->columnSpanFull()
                      ->required(),
                      RichEditor::make('description')
                      ->columnSpanFull(),
                      TextInput::make('slug')
                      ->readOnly(),
                      TagsInput::make('tags')
                      ->required()
                      ->separator(','),
                    ]),
                    
                  ])
                  
                 
                ]),
                Step::make('Gallery')
                  ->icon('heroicon-o-camera')
                  ->schema([
                    FileUpload::make('image')
                    ->directory('facility-images')
                      ->label('Cover Image')
                      ->required(),
                  ]),
                Step::make('Contact Information')
                  ->icon('heroicon-o-identification')
                  ->schema([
                    Group::make()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                      TextInput::make('phone')
                        ->tel(),
                      TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                      Select::make('location')
                      ->options(Location::pluck('name')->mapWithKeys(function ($location){
                        return [$location => $location];
                      }))
                      ->searchable(),
                      TextInput::make('address'),
                      TextInput::make('website'),
                      TextInput::make('google_maps'),
                      
                    ])
                  ]),
              ])->skippable(),
              ])
          ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('image'),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('location')
                ->searchable(),
                TextColumn::make('category.name')
                ->searchable(),
                TextColumn::make('tags')
                ->searchable(),
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
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'view' => Pages\ViewFacility::route('/{record}'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
            'managers' => Pages\Managers::route('/{record}/managers'),
            'services' => Services::route('/{record}/services')
        ];
    }
}
