<?php

namespace App\Http\Controllers;

use App\Enums\ReasonSubmission;
use App\Enums\UserRole;
use App\Http\Requests\Search\SearchEventRequest;
use App\Http\Requests\Store\StoreEventRequest;
use App\Http\Requests\Update\UpdateEventRequest;
use App\Repository\EventRepository;
use App\Repository\StadiumRepository;
use Carbon\Carbon;

class EventController extends Controller
{
    private EventRepository $eventRepository;
    private StadiumRepository $stadiumRepository;

    public function __construct(EventRepository $eventRepository, StadiumRepository $stadiumRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->stadiumRepository = $stadiumRepository;
    }

    public function welcome()
    {
        return view('layout.main', [
            'closestTimeEvent' => $this->eventRepository->orderByData(4),
            'mostCommentEvent' => $this->eventRepository->mostComment(4)
        ]);
    }

    private function viewList(SearchEventRequest $request, string $link)
    {
        $data = $request->validated();

        $value = $data['value'] ?? null;
        $sortSearch = $data['sortSearch'] ?? 'name';
        $sortDirection = $data['sortDirection'] ?? 'asc';
        $facility = $data['facility'] ?? 0;
        $filterData = $data['filterData'] ?? null;

        $resultPaginator = $this->eventRepository->filterBy(
            $value,
            $sortSearch,
            $sortDirection,
            $facility,
            $filterData
        );

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

    public function index(SearchEventRequest $request)
    {
        return $this->viewList($request, 'event.list');
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) $imagePath = $request->file('image')->store('events', 'public');

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

    public function dashboard(SearchEventRequest $request)
    {
        $this->authorize('isAdmin', 'role');
        return $this->viewList($request, 'dashboard.admin.event.main');
    }

    public function show(int $eventId)
    {
        return view('event.show', [
            'event' => $this->eventRepository->get($eventId),
            'reasons' => ReasonSubmission::cases(),
            'dateNotBuy' => Carbon::now()->addDays(3),
            'userRoleClient' => UserRole::USER->value
        ]);
    }

    public function edit(int $eventId)
    {
        $this->authorize('isAdmin', 'role');
        return view('dashboard.admin.event.edit', [
            'event' => $this->eventRepository->get($eventId),
            'stadiums' => $this->stadiumRepository->all()
        ]);
    }

    public function update(UpdateEventRequest $request)
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
}
