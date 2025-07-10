<?php

namespace App\Repository;

use App\Models\Stadium;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface StadiumRepository{
    public function get(int $id): Stadium;
    public function update(int $id, string $name, string $description = null, string $city, string $street, string $numberBuilding, int $places, $imagePath = null);
    public function add(string $name, string $description = null, string $city, string $street, string $numberBuilding, int $places, $imagePath = null);
    public function allPaginated(int $limit): LengthAwarePaginator;
    public function all(): Collection;
    public function filterBy(string $name = null, int $limit): LengthAwarePaginator;
}
