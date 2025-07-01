<?php

namespace App\Repository;

use App\Models\Submission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface SubmissionRepository{
    public function get(int $id): Submission;
    public function add(string $reason, string $content, int $comment_id);
    public function filterBy(string $contentSearch = null, string $sortSearch): Collection;
    public function allPaginated(int $limit): LengthAwarePaginator;
    public function all(): Collection;
}
