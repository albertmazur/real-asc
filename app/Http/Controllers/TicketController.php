<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Enums\UserRole;
use App\Http\Requests\VerifyTicketRequest;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Repository\TicketRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Store\StoreTicketRequest;
use App\Http\Requests\Update\UpdateTicketRequest;
use Laravel\Cashier\Exceptions\IncompletePayment;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $sortEventSearch = $request->get('sortEventSearch') ?? -2;
        $tickets = $this->ticketRepository->myTickets($sortEventSearch, TicketStatus::PURCHASED->value);

        foreach ($tickets as $ticket) {
            $ticket->qr_code = QrCode::size(250)->generate( $ticket->qr_token);
        }

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
     * @param  \App\Http\Requests\Store\StoreTicketRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        if(!Gate::allows(UserRole::USER->value, Auth::user()))
        {
            return response()->json(['success' => false, 'error' => __('error.no_permissions')], 403);
        }

        $data = $request->validated();
        $user = auth()->user();
        $event = Event::findOrFail($data['event_id']);
        $amount = $event->price * 100;
        try
        {
            $paymentIntent = $user->charge($amount, $data['payment_method']);
            $this->ticketRepository->add($data['countTickets'], $data['event_id'], $paymentIntent->id);
            return response()->json(['success' => true, 'message' => __('app.success_buy_ticket')]);
        }
        catch (IncompletePayment $exception)
        {
            return response()->json(['success' => false, 'error' => __('app.3D_secure')], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Update\UpdateTicketRequest $request
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function history(Request $request)
    {
        if(Gate::allows(UserRole::USER->value, Auth::user()))
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
        if (!Gate::allows(UserRole::USER->value, Auth::user())) abort(403);

        $id = $request->get('id');
        $success = $this->ticketRepository->backTicket($id);

        return back()->with($success ? 'success' : 'error', __($success ? 'app.success_return' : 'app.error_return'));
    }

    public function paymentStatus(){
        return back()->with('success', __('app.success_buy_ticket'));
    }

    public function scanner(){
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()) || Gate::allows(UserRole::MODERATOR->value, Auth::user())){
            return view('dashboard.admin.ticket.verify');
        }
        else abort(403);
    }

    public function verifyQr(VerifyTicketRequest $request){
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()) || Gate::allows(UserRole::MODERATOR->value, Auth::user())){
            $ticket = $this->ticketRepository->getWithToken($request->validated()['token']);

            if ($ticket->used_at) {
                return response()->json([
                    'success' => false,
                    'message' => __('dashboard.ticket.already_used', ['date' => $ticket->used_at])
                ]);
            }

            $ticket->used_at = now();
            $ticket->save();

            return response()->json([
                'success' => true,
                'ticket_id' => $ticket->id,
                'message' => __('dashboard.ticket.ticket_verified')
            ]);
        }
        else abort(403);
    }
}
