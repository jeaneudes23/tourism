<?php

namespace App\Filament\Facility\Resources\BlogResource\Pages;

use App\Filament\Facility\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;
}
