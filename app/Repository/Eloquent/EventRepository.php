<?php

namespace App\Repository\Eloquent;

use App\Models\Event;
use App\Repository\EventRepository as Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EventRepository implements Repository{
    private Event $eventModel;

    public function __construct(Event $event)
    {
        $this->eventModel = $event;
    }

    public function add(string $name, string $description = null, string $date, string $time, float $price, int $stadium_id, $imagePath = null)
    {
        $event = new Event;
        $event->name = $name;
        $event->description = $description;
        $event->date = $date;
        $event->time = $time;
        $event->price = $price;
        $event->price = $price;
        $event->stadium_id = $stadium_id;
        $event->image = $imagePath;
        $event->save();
    }

    public function update(int $id, string $name, ?string $description = null, string $date, string $time, float $price, int $stadium_id, $imagePath = null)
    {
        $event = $this->eventModel->find($id);
        $event->name = $name;
        $event->description = $description;
        $event->date = $date;
        $event->time = $time;
        $event->price = $price;
        $event->price = $price;
        $event->stadium_id = $stadium_id;
        $event->image = $imagePath;
        $event->save();
    }

    public function get(int $id): Event{
        return $this->eventModel->find($id);
    }

    public function allPaginated(int $limit): LengthAwarePaginator
    {
        return $this->eventModel->orderBy('name')->paginate($limit);
    }

    public function all(): Collection{
        return $this->eventModel->all();
    }

    public function orderByData(int $limit): Collection{
        return $this->eventModel->where('date', '>', Carbon::today())->orderBy('date')->orderBy('time')->limit($limit)->get();
    }

    public function mostComment(int $limit): Collection{
        return $this->eventModel->withCount('comments')->orderBy('comments_count', 'desc')->limit($limit)->get();
    }

    public function filterBy(string $name = null, string $sort = 'name', int $limit): LengthAwarePaginator{
        $query = $this->eventModel;

        if($sort === 'freeSet')
        {
            $query = $query->selectRaw('events.*, (stadiums.places - COUNT(tickets.id)) AS freeSet')
                ->join('stadiums', 'events.stadium_id', '=', 'stadiums.id')
                ->leftJoin('tickets', function ($join) {
                    $join->on('events.id', '=', 'tickets.event_id')
                         ->where('tickets.state', '=', 'Kupiony');
                })
                ->groupBy('events.id', 'stadiums.places')
                ->orderBy('freeSet');
        }
        else $query = $query->orderBy($sort);
        
        if($name) $query = $query->where('name', 'like', $name.'%');
        
        return $query->paginate($limit);
    }
}
