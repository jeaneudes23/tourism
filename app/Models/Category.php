<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\In;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];

    protected $append = ['facilities_count'];
    public function facilities () : HasMany
    {
        return $this->hasMany(Facility::class);
    }
    
    public function getFacilitiesCountAttribute() : int
    {
        return $this->facilities->count();
    }
}
