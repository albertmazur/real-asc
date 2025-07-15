<?php

namespace App\Http\Controllers;

use App\Enums\ReasonSubmission;
use App\Enums\UserRole;
use App\Http\Requests\EventSearchRequest;
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

    public function __construct(EventRepository $eventRepository, StadiumRepository $stadiumRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->stadiumRepository = $stadiumRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */

    private function viewList(EventSearchRequest $request, string $link)
    {
        $data = $request->validated();
        $value = $data['value'] ?? null;
        $sortSearch = $data['sortSearch'] ?? 'name';
        $sortDirection = $data['sortDirection'] ?? 'asc';
        $facility = $data['facility'] ?? 0;
        $filterData = $data['filterData'] ?? null;

        $resultPaginator = $this->eventRepository->filterBy($value, $sortSearch, $sortDirection, $facility, $filterData);

        $resultPaginator->appends([
            'value' => $value,
            'sortSearch' => $sortSearch,
            'sortDirection' => $sortDirection,
            'filterData' => $filterData
        ]);

        $viewData = [
            'events' => $resultPaginator,
            'value' => $value,
            'stadiums' => $this->stadiumRepository->all(),
            'facility' => $facility,
            'sortSearch' => $sortSearch,
            'sortDirection' => $sortDirection,
            'filterData' => $filterData
        ];
        
        return view($link, $viewData);
    }

    public function index(EventSearchRequest $request)
    {
        return $this->viewList($request, 'event.list');
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
     * @param  \App\Http\Requests\Store\StoreEventRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEventRequest $request)
    {
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
            $data = $request->validated();

            $imagePath = null;
            if ($request->hasFile('image')){
                $imagePath = $request->file('image')->store('events', 'public');
            }

            $this->eventRepository->add(
                $data['name'],
                $data['description'],
                $data['date'],
                $data['time'],
                $data['price'],
                $data['stadium_id'],
                $imagePath
            );

            return back()->with('success', __('dashboard.event.add'));
        }
        else abort(403);
    }

    public function dashboard(EventSearchRequest $request)
    {
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
            return $this->viewList($request, 'dashboard.admin.event.main');
        }
        else abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $eventId)
    {
        return view('event.show', [
            'event' => $this->eventRepository->get($eventId),
            'reasons' => ReasonSubmission::cases(),
            'dateNotBuy' => Carbon::now()->addDays(3),
            'userRoleClient' => UserRole::USER->value
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $eventId)
    {
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
            return view('dashboard.admin.event.edit', [
                'event' => $this->eventRepository->get($eventId),
                'stadiums' => $this->stadiumRepository->all()
            ]);
        }
        else abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Update\UpdateEventRequest $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function update(UpdateEventRequest $request)
    {
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
            $data = $request->validated();

            $imagePath = null;
            if ($request->hasFile('image')) $imagePath = $request->file('image')->store('events', 'public');

            $this->eventRepository->update(
                $data['id'],
                $data['name'],
                $data['description'],
                $data['date'],
                $data['time'],
                $data['price'],
                $data['stadium_id'],
                $imagePath
            );

            return redirect()->route('event.dashboard')->with('success', __('dashboard.event.update'));
        }
        else abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function welcome()
    {
        return view('layout.main', [
            'closestTimeEvent' => $this->eventRepository->orderByData(4),
            'mostComentEvent' => $this->eventRepository->mostComment(4)
        ]);
    }

}
