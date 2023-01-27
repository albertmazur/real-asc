<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\Store\StoreEventRequest;
use App\Http\Requests\Update\UpdateEventRequest;
use App\Repository\EventRepository;
use App\Repository\StadiumRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    private EventRepository $eventRepository;
    private StadiumRepository $stadiumRepository;

    public function __construct(EventRepository $eventRepository, StadiumRepository $stadiumRepository){
        $this->eventRepository = $eventRepository;
        $this->stadiumRepository = $stadiumRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function viewList(Request $request, string $link){
        $name = $request->get("nameSearch");
        $sort = $request->get("sortSearch") ?? "name";

        if($sort=="freeSet") $resultPaginator = $this->eventRepository->filterBy($name, "name", 10);
        else $resultPaginator = $this->eventRepository->filterBy($name, $sort, 10);

        $result = $resultPaginator->getCollection();
        $result->map(function ($item) {
            $item->freeSet = (($item->stadium->places)-($item->tickets->count()));
            return $item;
        });

        if($sort=="freeSet") $result = $result->sortBy('freeSet');
        $resultPaginator->setCollection($result);
        $resultPaginator->appends(["nameSearch" => $name, "sortSearch" => $sort]);
        if($link=="dashboard.admin.event") return view($link, ["events" => $resultPaginator, "nameSearch" => $name, "sortSearch" => $sort, "stadiums" => $this->stadiumRepository->all()]);
        else return view($link, ["events" => $resultPaginator, "nameSearch" => $name, "sortSearch" => $sort]);
    }

    public function index(Request $request){
        return $this->viewList($request, "events.list");
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
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request){
        if (Gate::allows('admin', Auth::user())) {
            $data = $request->validated();
            $this->eventRepository->add($data["name"], $data["description"], $data["date"], $data["time"], $data["price"], $data["stadium_id"]);
            return back()->with("success", "Dodano wydarzenie");;
        }
        else abort(403);
    }

    public function dashboard(Request $request){
        if (Gate::allows('admin', Auth::user())) {
            return $this->viewList($request, "dashboard.admin.event");
        }
        else abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(int $eventId){
        return view("events.show", ["event" => $this->eventRepository->get($eventId), "dateNotBuy" => Carbon::now()->addDays(3)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(int $eventId){
        if (Gate::allows('admin', Auth::user())) {
            return view("dashboard.admin.editEvent", ["event" => $this->eventRepository->get($eventId), "stadiums" => $this->stadiumRepository->all()]);
        }
        else abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request){
        if (Gate::allows('admin', Auth::user())) {
            $data = $request->validated();
            $this->eventRepository->update($data["id"], $data["name"], $data["description"], $data["date"], $data["time"], $data["price"], $data["stadium_id"]);
            return  redirect()->route("event.dashboard")->with("success", "Zaktualizowano wydarzenie");
        }
        else abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function welcome(){
        return view("main", ["closestTimeEvent" => $this->eventRepository->orderByData(4), "mostComentEvent" => $this->eventRepository->mostComment(4)]);
    }

}
