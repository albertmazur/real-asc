<?php

namespace App\Repository\Eloquent;

use App\Models\Stadium;
use App\Repository\StadiumRepository as Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class StadiumRepository implements Repository{
    private Stadium $stadiumModel;

    public function __construct(Stadium $stadium)
    {
        $this->stadiumModel = $stadium;
    }

    public function get(int $id): Stadium{
        return $this->stadiumModel->find($id);
    }

    public function add(string $name, string $city, string $street, string $numberBuilding, int $places)
    {
        $this->stadiumModel->create([
            'name' => $name,
            'city' => $city,
            'street' => $street,
            'numberBuilding' => $numberBuilding,
            'places'=>$places
        ]);
    }

    public function update(int $id, string $name, string $city, string $street, string $numberBuilding, int $places)
    {
        $stadium = $this->stadiumModel->find($id);
        $stadium->name = $name;
        $stadium->city = $city;
        $stadium->street = $street;
        $stadium->numberBuilding = $numberBuilding;
        $stadium->places = $places;
        $stadium->save();
    }


    public function allPaginated(int $limit): LengthAwarePaginator
    {
        return $this->stadiumModel->orderBy(['date', 'time'])->paginate($limit);
    }

    public function all(): Collection{
        return $this->stadiumModel->all();
    }

    public function filterBy(string $name = null, int $limit): LengthAwarePaginator
    {
        $query = $this->stadiumModel;
        if($name) $query = $query->where('name', 'like', $name.'%');
        return $query->paginate($limit);
    }
}
