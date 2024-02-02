<?php

namespace App\Filament\Pages\Tenancy;

use App\Filament\Resources\FacilityResource;
use App\Models\Facility;
use Filament\Forms\Components\FileUpload;
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
            Select::make('category_id')
            ->relationship('category','name')
            ->searchable()
            ->preload(),
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
            TextInput::make('slug')
            ->readOnly(),
            TagsInput::make('tags')
            ->required()
            ->separator(','),
        ]);
    }
    
    protected function handleRegistration(array $data): Facility
    {
        $facility = Facility::create($data);

        auth()->user()->update([
            'type' => 'manager'
        ]);
        
        $facility->managers()->attach(auth()->user());
        
        return $facility;
    }
}


?>