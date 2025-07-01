<div class="card mb-3">
    <p class="card-header h5">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</p>
    <div class="card-body">
        <h5 class="card-title">{{ $comment->reason }}</h5>
        <p class="card-text">{{ $comment->content }}</p>
        <p class="card-text">{{ $comment->event->name }}</p>
        <form method="POST" action="{{ route('comment.remove') }}">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $comment->id }}">
            <input type="submit" class="btn btn-danger" value="{{ __('dashboard.comment.delete') }}">
        </form>
    </div>
</div>
