<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'users';

    protected $guarded = [];


    public function facilities() : BelongsToMany
    {
        return $this->belongsToMany(Facility::class);
    }

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
