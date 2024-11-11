<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\In;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $append = ['facilities_count'];

    protected static function booted()
    {
      static::creating(function(Category $category){
        $category->slug = Str::slug($category->name);
      });

      static::updating(function(Category $category){
        $category->slug = Str::slug($category->name);
      });
    }
    public function facilities () : BelongsToMany
    {
        return $this->belongsToMany(Facility::class);
    }
    
    public function getFacilitiesCountAttribute() : int
    {
        return $this->facilities->count();
    }
}
