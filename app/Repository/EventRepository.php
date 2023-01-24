<?php

namespace App\Repository;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface EventRepository{
    public function get(int $id): Event;
    public function add(string $name, string $description = null, string $date, string $time, float $price, int $stadium_id);
    public function update(int $id, string $name, string $description = null, string $date, string $time, float $price, int $stadium_id);
    public function allPaginated(int $limit): LengthAwarePaginator;
    public function all(): Collection;
    public function filterBy(string $name = null, string $sort = "name", int $limit):LengthAwarePaginator;
    public function orderByData(int $limit): Collection;
    public function mostComment(int $limit): Collection;
    //public function filterBy(string $name): LengthAwarePaginator;
}
