<?php

namespace App\Repository\Eloquent;

use App\Models\Stadium;
use App\Repository\StadiumRepository as Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StadiumRepository implements Repository{
    private Stadium $stadiumModel;

    public function __construct(Stadium $stadium)
    {
        $this->stadiumModel = $stadium;
    }

    public function get(int $id): Stadium{
        return $this->stadiumModel->findOrFail($id);
    }

    public function add(string $name, string $description = null, string $city, string $street, string $numberBuilding, int $places, $imagePath = null)
    {
        $this->stadiumModel->create([
            'name' => $name,
            'description' => $description,
            'city' => $city,
            'street' => $street,
            'numberBuilding' => $numberBuilding,
            'places' => $places,
            'image' => $imagePath
        ]);
    }

    public function update(int $id, string $name, string $description = null, string $city, string $street, string $numberBuilding, int $places, $imagePath = null)
    {
        $stadium = $this->stadiumModel->findOrFail($id);
        $stadium->name = $name;
        $stadium->description = $description;
        $stadium->city = $city;
        $stadium->street = $street;
        $stadium->numberBuilding = $numberBuilding;
        $stadium->places = $places;
        $stadium->image = $imagePath;
        $stadium->save();
    }


    public function allPaginated(int $limit): LengthAwarePaginator
    {
        return $this->stadiumModel->orderBy('date')->orderBy('time')->paginate($limit);
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
