<?php

namespace App\Filament\Facility\Resources;

use App\Filament\Facility\Resources\ManagerResource\Pages;
use App\Filament\Facility\Resources\ManagerResource\RelationManagers;
use App\Filament\Resources\UserResource;
use App\Models\Manager;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManagerResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Manager';

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $tenantOwnershipRelationshipName = 'facilities';
    protected static ?string $tenantRelationshipName = 'managers';

    public static function getNavigationBadge(): ?string
    {
        return Filament::getTenant()->managers->count();
    }


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
            'index' => Pages\ListManagers::route('/'),
            'create' => Pages\CreateManager::route('/create'),
            'view' => Pages\ViewManager::route('/{record}'),
            'edit' => Pages\EditManager::route('/{record}/edit'),
        ];
    }
}
