<?php

namespace App\Repository\Eloquent;

use Stripe\Refund;
use Stripe\Stripe;
use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\TicketRepository as Repository;

class TicketRepository implements Repository{
    private Ticket $ticketModel;

    public function __construct(Ticket $ticket)
    {
        $this->ticketModel = $ticket;
    }

    public function add(int $count, int $event_id, string $stripe_payment_id)
    {
        for($i = 0; $i < $count; $i++)
        {
            $ticket = new Ticket();
            $ticket->user_id = Auth::id();
            $ticket->event_id = $event_id;
            $ticket->stripe_payment_id = $stripe_payment_id;
            $ticket->save();
        }

        //for($i=0; $i<$count; $i++) $this->ticketModel->create(['user_id' => Auth::id(), 'event_id' => $event_id]);
    }

    public function get(int $id): Ticket{
        return $this->ticketModel->find($id);
    }

    public function myTickets(int $sortEventSearch, string $how = 'All'): Collection{
        $query = $this->ticketModel->where('user_id', '=', Auth::id());

        if($sortEventSearch != -2) $query = $query->where('event_id', '=', $sortEventSearch);

        if($how == 'Kupiony') $query = $query->where('state', '=', 'Kupiony');
        if($how == 'Zwrócony') $query = $query->where('state', '=', 'Zwrócony');
        return $query->get();
    }

    public function allPaginated(int $limit): LengthAwarePaginator{
        return $this->ticketModel->orderBy('name')->paginate($limit);
    }

    public function all(): Collection{
        return $this->ticketModel->all();
    }

    public function orderByData(int $limit): Collection{
        return $this->ticketModel
            ->where('date', '>', Carbon::today())
            ->orderBy('date')->orderBy('time')
            ->limit($limit)
            ->get();
    }

    public function mostComment(int $limit): Collection{
        return $this->ticketModel
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit($limit)
            ->get();
    }

    public function backTicket(int $id): bool{
        $ticket = $this->ticketModel->find($id);
        $ticket->state = 'Zwrócony';

        try
        {
            Stripe::setApiKey(config('services.stripe.secret')); 
            Refund::create([
                'payment_intent' => $ticket->stripe_payment_id,
            ]);

            if($ticket->event->date>(Carbon::now()->addDays(3)))
            {
                $ticket->update();
                return true;
            }
            else return false;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
}
