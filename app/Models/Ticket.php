<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateBuy',
        'timeBuy',
        'event_id',
        'user_id', 
        'state'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $mytime = Carbon::now();
            $model->dateBuy = $mytime->toDate();
            $model->timeBuy = $mytime->toDateTimeString();
            $model->state=TicketStatus::PURCHASED->value;
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
