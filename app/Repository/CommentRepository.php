<?php

namespace App\Repository;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepository{
    public function get(int $id): Comment;
    public function add(string $content, int $event_id);
    public function filterBy(int $who, string $content = null, int $event = null): Collection;
    public function allPaginated(int $limit): LengthAwarePaginator;
    public function all(): Collection;
    public function delete(int $id);
}
