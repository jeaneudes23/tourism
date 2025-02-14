<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'tags' => 'array',
        'attachments' => 'array',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
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

        if ($location) {
            $query->where('location', 'like', '%' . $location . '%');
        }

        if ($q) {
            $query->where('tags', 'like', '%' . $q . '%')->orWhere('name' , 'like' ,'%'. $q .'%');
        }

        if ($category) {
            $query->where('category_id', 'like', '%' . $category . '%');
        }

        return $query->paginate(10);
    }
}
