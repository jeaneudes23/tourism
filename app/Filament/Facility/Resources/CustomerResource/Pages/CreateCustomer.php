<?php

namespace App\Filament\Facility\Resources\CustomerResource\Pages;

use App\Filament\Facility\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
