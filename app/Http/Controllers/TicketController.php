<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Event;
use App\Models\Ticket;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Repository\TicketRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Store\StoreTicketRequest;
use App\Http\Requests\Update\UpdateTicketRequest;
use Laravel\Cashier\Exceptions\IncompletePayment;

class TicketController extends Controller
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortEventSearch = $request->get('sortEventSearch') ?? -2;
        $tickets = $this->ticketRepository->myTickets($sortEventSearch, 'Kupiony');
        return view('dashboard.client.ticket', [
            'sortEventSearch' => $sortEventSearch,
            'events' => Event::all(),
            'tickets' => $tickets,
            'now' => Carbon::now(),
            'option' => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        if(Gate::allows('client', Auth::user()))
        {
            $date = $request->validated();
            $user = auth()->user();
            try
            {
                $user->charge(1000, $date['payment_method']); // Pobiera 10 PLN (1000 groszy)
                $this->ticketRepository->add($date['countTickets'], $date['event_id']);
                return back()->with('success', __('app.success_buy_ticket'));
            }
            catch (IncompletePayment $exception)
            {
                return back()->with('error', 'Wymagana autoryzacja 3D Secure');
            }
        }
        else abort(403);
    }

    public function createPaymentIntent()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    
        $paymentIntent = PaymentIntent::create([
            'amount' => 1000, // 10 PLN (wartość w groszach)
            'currency' => 'pln',
        ]);
    
        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function history(Request $request)
    {
        if(Gate::allows('client', Auth::user()))
        {
            $sortEventSearch = $request->get('sortEventSearch') ?? -2;
            $tickets = $this->ticketRepository->myTickets($sortEventSearch);
            return view('dashboard.client.historyTicket', [
                'sortEventSearch' => $sortEventSearch,
                'events' => Event::all(),
                'tickets' => $tickets,
                'option' => false
            ]);
        }
        else abort(403);
    }

    public function backTicket(Request $request)
    {
        if(Gate::allows('client', Auth::user()))
        {
            $id = $request->get('id');
            $f = $this->ticketRepository->backTicket($id);

            $p = '';
            $message = '';
            if($f)
            {
                $p ='success';
                $message = __('app.success_return_ticket');
            }
            else
            {
                $p = 'error';
                $message = __('app.error_return_ticket');
            }

            return back()->with($p, $message);
        }
        else abort(403);
    }
}
