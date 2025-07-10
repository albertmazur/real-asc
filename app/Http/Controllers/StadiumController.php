<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Stadium;
use App\Http\Requests\Store\StoreStadiumRequest;
use App\Http\Requests\Update\UpdateStadiumRequest;
use App\Repository\StadiumRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StadiumController extends Controller
{
    private StadiumRepository $stadiumRepository;

    public function __construct(StadiumRepository $stadiumRepository)
    {
        $this->stadiumRepository = $stadiumRepository;
    }

    public function list(){
        $stadiums = $this->stadiumRepository->allPaginated(5);

        return view('stadium.list', [
            'stadiums' => $stadiums,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $name = $request->get('nameSearch');
        $resultPaginator = $this->stadiumRepository->filterBy($name, 10);

        return view('dashboard.admin.stadium.main', [
            'stadiums' => $resultPaginator,
            'nameSearch' => $name
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
     * @param  \App\Http\Requests\Store\StoreStadiumRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStadiumRequest $request)
    {
        $date = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stadium', 'public');
        }
        // dd($imagePath);
        $this->stadiumRepository->add($date['name'], $date['description'], $date['city'], $date['street'], $date['numberBuilding'], $date['places'], $imagePath);

        return back()->with('success', __('dashboard.stadium.added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function show(int $stadiumId)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $stadiumId)
    {
        return view('dashboard.admin.stadium.edit', [
            'stadium' => $this->stadiumRepository->get($stadiumId)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Update\UpdateStadiumRequest $request
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStadiumRequest $request)
    {
        if(Gate::allows(UserRole::ADMIN->value, Auth::user()))
        {
            $date = $request->validated();
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('stadium', 'public');
            }

            $this->stadiumRepository->update($date['id'], $date['name'], $date['description'], $date['city'], $date['street'], $date['numberBuilding'], $date['places'], $imagePath);

            return redirect()->route('stadium.index')->with('success', __('app.save_changes'));
        }
        else abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stadium $stadium)
    {
        //
    }
}
