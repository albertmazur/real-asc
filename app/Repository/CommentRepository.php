<?php

namespace App\Repository;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepository{
    public function get(int $id): Comment;
    public function add(string $content, int $event_id);
    public function filterBy(string $contentSearch, int $sortWhoSearch, int $sortEventSearch): Collection;
    public function allPaginated(int $limit): LengthAwarePaginator;
    public function all(): Collection;
    //public function myComments(int $idUser, string $contentSearch, int $eventId): Collection;
    //public function filterBy(string $name): LengthAwarePaginator;
}
