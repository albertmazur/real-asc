<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\Store\StoreCommentRequest;
use App\Http\Requests\Update\UpdateCommentRequest;
use App\Models\Event;
use App\Models\User;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if(Gate::allows('admin', Auth::user()) || Gate::allows('moderator', Auth::user()))
        {
            $contentSearch = $request->get('contentSearch');
            $sortWhoSearch = $request->get('sortWhoSearch') ?? -2;
            $sortEventSearch = $request->get('sortEventSearch') ?? -2;

            return view('dashboard.comment.comment', [
                'comments' => $this->commentRepository->filterBy($contentSearch, $sortWhoSearch, $sortEventSearch),
                'nameSearch' => $contentSearch,
                'sortWhoSearch' => $sortWhoSearch,
                'sortEventSearch' => $sortEventSearch,
                'users' => User::all(),
                'events' => Event::all()
            ]);
        } 
        else abort(403);
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
     * @param  \App\Http\Requests\Store\StoreCommentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $this->commentRepository->add($data['content'], $data['event_id']);
        return back()->with('success', __('dashboard.comment.add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Update\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if(Gate::allows('admin', Auth::user()) || Gate::allows('moderator', Auth::user()))
        {
            $data = $request->validate(['id' => ['required', 'integer']]);
            $comment = Comment::find($data['id']);
            $comment->delete();
            return back()->with('success', __('dashboard.comment.deleted'));
        }
        else abort(403);
    }

    public function myComments(Request $request)
    {
        if(Gate::allows('client', Auth::user()))
        {
            $contentSearch = $request->get('contentSearch');
            $sortEventSearch = $request->get('sortEventSearch') ?? -2;

            return view('dashboard.client.comment', [
                'comments' => $this->commentRepository->filterBy($contentSearch, Auth::id(), $sortEventSearch),
                'nameSearch' => $contentSearch,
                'sortEventSearch' => $sortEventSearch,
                'events' => Event::all()
            ]);
        }
        else abort(403);
    }
}
