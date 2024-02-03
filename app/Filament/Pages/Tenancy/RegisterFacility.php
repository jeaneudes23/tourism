<?php

namespace App\Filament\Pages\Tenancy;

use App\Filament\Resources\FacilityResource;
use App\Models\Facility;
use App\Models\Location;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
 
class RegisterFacility extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Facility';
    }
    public function hasLogo(): bool
    {
        return true;
    }
    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Group::make()
            ->columnSpanFull()
            ->columns(2)
            ->schema([
                Select::make('category_id')
                ->relationship('category','name')
                ->searchable()
                ->preload(),
                Select::make('location')
                ->options(Location::pluck('name')->mapWithKeys(function ($location){
                return [$location => $location];
                }))
                ->searchable(),
            ]),
            
            TextInput::make('name')
            ->live(onBlur: true)
            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
            ->required(),
            
            Textarea::make('title')
            ->required(),
            FileUpload::make('image')
            ->directory('facility-images')
            ->label('Cover Image')
            ->required(),
        ]);
    }
    
    protected function handleRegistration(array $data): Facility
    {
        $data['slug'] = Str::slug($data['name']);
        $facility = Facility::create($data);
        
        $facility->managers()->attach(auth()->user());
        
        return $facility;
    }
}


?>