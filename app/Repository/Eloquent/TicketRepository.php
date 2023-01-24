<?php

namespace App\Repository\Eloquent;

use App\Models\Ticket;
use App\Repository\TicketRepository as Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketRepository implements Repository{
    private Ticket $ticketModel;

    public function __construct(Ticket $ticket)
    {
        $this->ticketModel = $ticket;
    }

    public function add(int $count, int $event_id){
        for($i=0; $i<$count; $i++){
            $ticket = new Ticket();
            $ticket->user_id = Auth::id();
            $ticket->event_id = $event_id;
            $ticket->save();
        }

        //for($i=0; $i<$count; $i++) $this->ticketModel->create(["user_id" => Auth::id(), "event_id"=>$event_id]);
    }

    public function get(int $id): Ticket{
        return $this->ticketModel->find($id);
    }

    public function myTickets(int $idUser, $sortEventSearch): Collection{
        $query = $this->ticketModel->where("user_id", "=", $idUser)->where("state", "=", "Kupiony");
        if($sortEventSearch != -2) $query = $query->where("event_id", "=", $sortEventSearch);
        return $query->get();
    }

    public function allPaginated(int $limit): LengthAwarePaginator{
        return $this->ticketModel->orderBy("name")->paginate($limit);
    }

    public function all(): Collection{
        return $this->ticketModel->all();
    }

    public function orderByData(int $limit): Collection{
        return $this->ticketModel->where("date", ">", Carbon::today())->orderBy("date")->orderBy('time')->limit($limit)->get();
    }

    public function mostComment(int $limit): Collection{
        return $this->ticketModel->withCount('comments')->orderBy('comments_count', 'desc')->limit($limit)->get();
    }

    public function backTicket(int $id): bool{
        $ticket = $this->ticketModel->find($id);
        $ticket->state = "Zwrócony";

        if($ticket->event->date>(Carbon::now()->addDays(3))){
            $ticket->update();
            return true;
        }
        else return false;
    }
}
