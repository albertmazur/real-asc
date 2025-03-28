<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'date', 'time', 'price', 'stadium_id'];

    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsSort()
    {
        return $this->comments()->orderByDesc('date')->orderByDesc('time')->get();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function freePlaces()
    {
        return $this->stadium->places - $this->tickets->where('state', '=', "Kupiony")->count();
    }
}
