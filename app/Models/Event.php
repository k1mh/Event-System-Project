<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
// Relation: 1 Event belong to 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
