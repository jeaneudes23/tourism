<?php

namespace App\Filament\Pages\Tenancy;

use App\Filament\Resources\FacilityResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
use Illuminate\Database\Eloquent\Model;
 
class EditFacilityProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Facility Profile';
    }
    
    public function form(Form $form): Form
    {
        return FacilityResource::form($form);
    }
}

?>