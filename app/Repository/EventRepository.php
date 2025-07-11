<?php

namespace App\Repository;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface EventRepository{
    public function get(int $id): Event;
    public function add(string $name, string $description = null, string $date, string $time, float $price, int $stadium_id, $imagePath = null);
    public function update(int $id, string $name, string $description = null, string $date, string $time, float $price, int $stadium_id, $imagePath = null);
    public function allPaginated(int $limit): LengthAwarePaginator;
    public function all(): Collection;
    public function filterBy(string $value = null, string $sortSearch = 'name', string $sortDirection = 'asc', int $facility, int $limit): LengthAwarePaginator;
    public function orderByData(int $limit): Collection;
    public function mostComment(int $limit): Collection;
}
