<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Http\Requests\Store\StoreSubmissionRequest;
use App\Http\Requests\Update\UpdateSubmissionRequest;
use App\Models\Comment;
use App\Repository\SubmissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubmissionController extends Controller
{
    private SubmissionRepository $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contentSearch = $request->get('contentSearch');
        $sortSearch = $request->get('sortSearch') ?? 'All';

        return view('dashboard.submission.submission', [
            'submissions' => $this->submissionRepository->filterBy($contentSearch, $sortSearch),
            'nameSearch' => $contentSearch,
            'sortSearch' => $sortSearch
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Store\StoreSubmissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubmissionRequest $request)
    {
        $data = $request->validated();
        $this->submissionRepository->add($data['reason'], $data['content'], $data['comment_id'],);
        return back()->with('success', __('app.added_submission'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Update\UpdateSubmissionRequest  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Gate::allows('admin', Auth::user()) || Gate::allows('moderator', Auth::user()))
        {
            $date = $request->validate(['id' => ['required', 'integer']]);
            $submission = Submission::findOrFail($date['id']);
            $comment = Comment::findOrFail($submission->comment_id);
            if($comment) $comment->delete();
            $submission->delete();
            return back()->with('success', __('dashboard.comment.deleted_comments_submission'));
        }
        else abort(403);
    }
}
