<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\Facilities;
use App\Filament\Resources\CategoryResource\Pages\Posts;
use App\Filament\Resources\CategoryResource\Pages\ViewCategory;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
  protected static ?string $model = Category::class;

  protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
  protected static ?string $navigationGroup = 'Collection';

  protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

  public static function getRecordSubNavigation(Page $page): array
  {
    return $page->generateNavigationItems([
      EditCategory::class,
      ViewCategory::class,
      Facilities::class,

    ]);
  }

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('')
          ->compact()
          ->columns(2)
          ->schema([
            TextInput::make('name')
            ->required(),
            TagsInput::make('tags')
              ->required()
              ->separator(','),
            FileUpload::make('image')
              ->columnSpanFull()
              ->directory('category-headers')
              ->required()
              ->image(),
            Textarea::make('description')
              ->required()
              ->rows(5)
              ->columnSpanFull(),
          ]),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        ImageColumn::make('image'),
        TextColumn::make('name'),
        TextColumn::make('tags')
          ->badge(),
        TextColumn::make('facilities_count')->counts('facilities'),
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
        TrashedFilter::make()
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

  public static function infolist(Infolist $infolist): Infolist
  {
    return $infolist
      ->schema([
        ComponentsSection::make()
          ->compact()
          ->schema([
            Split::make([
              TextEntry::make('name')
                ->hiddenLabel()
                ->size('lg')
                ->weight('bold'),
              
            ]),
            ImageEntry::make('image')
              ->extraImgAttributes(['class' => 'w-full'])
              ->height('auto')
              ->columnSpanFull()
              ->hiddenLabel(),
            TextEntry::make('description')
              ->columnSpanFull(),
            TextEntry::make('tags')
              ->badge()
              ->columnSpanFull(),
          ])
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
      'index' => Pages\ListCategories::route('/'),
      'create' => Pages\CreateCategory::route('/create'),
      'edit' => Pages\EditCategory::route('/{record}/edit'),
      'view' => Pages\ViewCategory::route('/{record}/view'),
      'facilities' => Facilities::route('/{record}/facilities')
    ];
  }
}
