<div class="card mb-3">
    <h5 class="card-header">{{ $comment->user->name }}</h5>
    <div class="card-body">
        <h5 class="card-title">{{ $comment->forWhat }}</h5>
        <p class="card-text">{{ $comment->content }}</p>
        <p class="card-text">{{ $comment->event->name }}</p>
        <form method="POST" action="{{ route("comment.remove") }}">
            @method("delete")
            @csrf
            <input type="hidden" name="id" value="{{ $comment->id }}">
            <input type="submit" class="btn btn-danger" value="{{ __("Usuń komentarz") }}">
        </form>
    </div>
</div>
