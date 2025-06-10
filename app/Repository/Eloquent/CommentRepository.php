<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Repository\CommentRepository as Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements Repository{
    private Comment $commentModel;

    public function __construct(Comment $comment)
    {
        $this->commentModel = $comment;
    }

    public function add(string $content, int $event_id)
    {
        $comment = new Comment();
        $comment->content = $content;
        $comment->user_id = Auth::id();
        $comment->event_id = $event_id;
        $comment->save();
        //Comment::factory()->create(['content' => $content, 'user_id' => Auth::id(), 'event_id' => $event_id]);
    }

    public function get(int $id): Comment{

        return $this->commentModel->findOrFail($id);
    }

    public function allPaginated(int $limit): LengthAwarePaginator
    {
        return $this->commentModel->orderBy(['date', 'time'])->paginate($limit);
    }

    public function all(): Collection{
        return $this->commentModel->all();
    }

    public function filterBy(string $contentSearch = null, int $sortWhoSearch, int $sortEventSearch): Collection{
        $query = $this->commentModel;

        if($sortWhoSearch != -2) $query =$query->where('user_id', '=', $sortWhoSearch);
        if($sortEventSearch != -2) $query =$query->where('event_id', '=', $sortEventSearch);
        if($contentSearch) $query =$query->where('content', 'like', $contentSearch.'%');

        return $query->get();
    }
}
