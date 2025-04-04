<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    protected $table = 'stadiums';
    protected $fillable = ['name', 'city', 'street', 'numberBuilding', 'places'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
