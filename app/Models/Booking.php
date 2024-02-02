<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded =[];

    public function facility() : BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class ,'users');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
