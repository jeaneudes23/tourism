<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Facility extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tags' => 'array',
        'attachments' => 'array',
    ];

    protected static function booted()
    {
      static::creating(function (Facility $facility) {
        $facility->slug = Str::slug($facility->name);
      });
      static::updating(function (Facility $facility) {
        $facility->slug = Str::slug($facility->name);
      });
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }



    public function services() : HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function customers() : BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function photos() : HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function managers() : BelongsToMany
    {
        return $this->belongsToMany(User::class ,'facility_manager','facility_id','manager_id');
    }

    public static function search($category , $location , $q)
    {
        $query = self::query();

        if (filled($location)) {
            $query->where('location', 'like', '%' . $location . '%');
        }

        if (filled($q)) {
            $query->where(function($sub) use($q) {
              $sub->where('tags', 'like', '%' . $q . '%')
              ->orWhere('name' , 'like' ,'%'. $q .'%')
              ->orWhere('address', 'like' , '%' . $q . '%')
              ->orWhereHas('services' , function($service) use($q) {
                $service->where('name','like','%'.$q.'%');
              });
              
            });
        }

        if (filled($category)) {
            $query->whereHas('categories' , function($inner) use($category){
              $inner->where('slug', 'like', '%' . $category . '%');
            });
        }

        return $query->paginate(10);
    }
}
