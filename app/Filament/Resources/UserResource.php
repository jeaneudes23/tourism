<?php

namespace App\Filament\Resources;

use App\Filament\Facility\Resources\UserResource as ResourcesUserResource;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Admin';

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type','admin');
    }

    public static function form(Form $form): Form
    {
        return ResourcesUserResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesUserResource::table($table);
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
