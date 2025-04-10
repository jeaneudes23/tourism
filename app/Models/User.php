<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser , HasTenants
{
    use HasApiTokens, SoftDeletes , HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['has_facility'];

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        
        if ($panel->getId() == 'admin')
        {
            return $this->is_admin == 1;
        }
        return true;
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->facilities;
    }
    
    public function facilities() : BelongsToMany
    {
        return $this->belongsToMany(Facility::class ,'facility_manager', 'manager_id');
    }


    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class , 'bookmarks' , 'customer_id');
    }


    public function canAccessTenant(Model $tenant): bool
    {
        return $this->facilities->contains($tenant);
    }

    public function getHasFacilityAttribute() 
    {
        return $this->facilities->count() > 0;
    }


}
