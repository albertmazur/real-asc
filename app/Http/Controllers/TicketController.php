<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\Store\StoreTicketRequest;
use App\Http\Requests\Update\UpdateTicketRequest;
use App\Models\Event;
use App\Repository\TicketRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository){
        $this->ticketRepository = $ticketRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $sortEventSearch = $request->get("sortEventSearch") ?? -2;
        $tickets = $this->ticketRepository->myTickets(Auth::id(), $sortEventSearch);
        return view("dashboard.client.ticket", ["sortEventSearch" => $sortEventSearch, "events" => Event::all(), "tickets" => $tickets, "now" => Carbon::now(), "option" => true]);
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
    public function store(StoreTicketRequest $request){
        if (Gate::allows('client', Auth::user())) {
            $date = $request->validated();
            $this->ticketRepository->add($date["countTickets"], $date["event_id"]);
            return back()->with("success", "Udało się kupić");
        }
        else abort(403);
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

    public function history(Request $request){
        if (Gate::allows('client', Auth::user())) {
            $sortEventSearch = $request->get("sortEventSearch") ?? -2;
            $tickets = $this->ticketRepository->myTickets(Auth::id(), $sortEventSearch);
            return view("dashboard.client.historyTicket", ["sortEventSearch" => $sortEventSearch, "events" => Event::all(), "tickets" => $tickets, "option" => false]);
        }
        else abort(403);
    }

    public function backTicket(Request $request){
        if(Gate::allows('client', Auth::user())){
            $id = $request->get("id");
            $f = $this->ticketRepository->backTicket($id);

            $p = "";
            $message = "";
            if($f){
                $p ="success";
                $message = "Udało się zwróćić";
            }
            else{
                $p = "error";
                $message = "Nie można zwrócić";
            }

            return back()->with($p, $message);
        }
        else abort(403);
    }
}
