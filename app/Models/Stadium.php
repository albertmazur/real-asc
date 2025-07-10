<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    protected $table = 'stadiums';
    protected $fillable = [
        'name',
        'description',
        'img',
        'city',
        'street',
        'numberBuilding',
        'places',
        'image'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
