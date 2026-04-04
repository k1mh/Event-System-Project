<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'capacity',
        'status',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];
    //
}
