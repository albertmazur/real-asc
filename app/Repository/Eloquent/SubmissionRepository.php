<?php

namespace App\Repository\Eloquent;

use App\Models\Submission;
use App\Repository\SubmissionRepository as Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SubmissionRepository implements Repository{
    private Submission $submissionModel;

    public function __construct(Submission $submission)
    {
        $this->submissionModel = $submission;
    }

    public function add(string $reason, string $content, int $comment_id)
    {
        $submission = new Submission();
        $submission->reason = $reason;
        $submission->content = $content;
        $submission->comment_id = $comment_id;
        $submission->save();
    }

    public function get(int $id): Submission{

        return $this->submissionModel->findOrFail($id);
    }

    public function allPaginated(int $limit): LengthAwarePaginator
    {
        return $this->submissionModel->paginate($limit);
    }

    public function all(): Collection{
        return $this->submissionModel->all();
    }

    public function filterBy(string $contentSearch = null, string $sortSearch): Collection{
        $query = $this->submissionModel->where('content', 'like', $contentSearch.'%');
        if($sortSearch!='All') $query = $query->where('reason', '=', $sortSearch);
        return $query->get();
    }
}
