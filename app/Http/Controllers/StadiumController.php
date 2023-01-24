<?php

namespace App\Http\Controllers;

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

    public function __construct(StadiumRepository $stadiumRepository){
        $this->stadiumRepository = $stadiumRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get("nameSearch");
        $resultPaginator = $this->stadiumRepository->filterBy($name, 10);

        return view("dashboard.admin.stadium", ["stadiums" => $resultPaginator, "nameSearch" => $name]);
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
     * @param  \App\Http\Requests\StoreStadiumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStadiumRequest $request)
    {
        $date = $request->validated();
        $this->stadiumRepository->add($date["name"], $date["city"], $date["street"], $date["numberBuilding"], $date["places"]);
        return back()->with("success", "Dodano stadion");
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
     * @return \Illuminate\Http\Response
     */
    public function edit(int $stadiumId)
    {
        return view("dashboard.admin.editStadium", ["stadium" => $this->stadiumRepository->get($stadiumId)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStadiumRequest  $request
     * @param  \App\Models\Stadium  $stadium
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStadiumRequest $request){
        if (Gate::allows('admin', Auth::user())) {
            $date = $request->validated();
            $this->stadiumRepository->update($date["id"], $date["name"], $date["city"], $date["street"], $date["numberBuilding"], $date["places"],);
            return redirect()->route("stadium.index");
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
