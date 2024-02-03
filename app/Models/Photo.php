<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    protected $guarded = [];
    use HasFactory , SoftDeletes;

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
