<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'dateBuy', 'timeBuy', 'event_id', 'user_id', 'state'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->number = fake()->randomNumber();
            $mytime = Carbon::now();
            $model->dateBuy = $mytime->toDate();
            $model->timeBuy = $mytime->toDateTimeString();
            $model->state='Kupiony';
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
