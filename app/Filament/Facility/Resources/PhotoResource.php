<?php

namespace App\Filament\Facility\Resources;

use App\Filament\Facility\Resources\PhotoResource\Pages;
use App\Filament\Facility\Resources\PhotoResource\RelationManagers;
use App\Models\Photo;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function getNavigationBadge(): ?string
    {
        return Filament::getTenant()->photos->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('')
                ->compact()
                ->schema([
                    FileUpload::make('url')
                    ->image()
                    ->directory('/facility/photos')
                    ->required(),
                    TextInput::make('description'),
                ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('url'),
                TextColumn::make('description')

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
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'view' => Pages\ViewPhoto::route('/{record}'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
}
