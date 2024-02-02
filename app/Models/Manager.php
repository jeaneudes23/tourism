<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Model
{
    use HasFactory;

    use HasFactory , SoftDeletes;

    protected $table = 'users';

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('manager', function (Builder $builder) {
            $builder->where('type', 'manager');
        });

        static::creating(function ($user) {
            $user->type = 'manager';
        });
    }
    
    public function facilities() : BelongsToMany
    {
        return $this->belongsToMany(Facility::class);
    }
}
