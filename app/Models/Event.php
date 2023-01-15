<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function stadium(){
        return $this->belongsTo(Stadium::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
