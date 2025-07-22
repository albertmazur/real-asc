<?php

namespace App\Http\Controllers;

use App\Http\Requests\Delete\DeleteSubmissionRequest;
use App\Http\Requests\Store\StoreSubmissionRequest;
use App\Repository\SubmissionRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    private SubmissionRepository $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('isAdminOrModerator', 'role');

        $contentSearch = $request->get('contentSearch');
        $sortSearch = $request->get('sortSearch') ?? 'All';

        return view('dashboard.submission.submission', [
            'submissions' => $this->submissionRepository->filterBy($contentSearch, $sortSearch),
            'nameSearch' => $contentSearch,
            'sortSearch' => $sortSearch
        ]);
    }

    public function store(StoreSubmissionRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->submissionRepository->add($data['reason'], $data['description'], $data['comment_id']);

        return back()->with('success', __('app.added_submission'));
    }

    public function destroy(DeleteSubmissionRequest $request)
    {
        $date = $request->validated();
        $action = $date['action'];

        $deleteComment = $action === 'submission_and_comment';
        $this->submissionRepository->deleteWithComment($date['id'], $deleteComment);

        return back()->with('success', __('dashboard.comment.deleted_comments_submission'));
    }
}
