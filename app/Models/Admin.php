<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    protected $table = 'users';
    protected $guarded = [] ;
    protected $hidden = [
      'password',
      'remember_token',
    ];
    use HasFactory , SoftDeletes;
    

    protected static function booted()
    {
        static::addGlobalScope('manager', function (Builder $builder) {
            $builder->where('role', 'admin');
        });

        static::creating(function ($user) {
            $user->role = 'admin';
        });
    }
    
}
