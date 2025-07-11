<div class="card mb-3">
        <p class="card-header h5">
            @if ($comment->user)
                {{ $comment->user->first_name }} {{ $comment->user->last_name }}
            @else
                {{ __('app.deleted_user') }}
            @endif
        </p>
    <div class="card-body">
        <p class="card-text">{{ __('dashboard.comment.event_name') }}:
            <br>{{ $comment->event->name }}
        </p>
        <p class="card-text">{{ __('dashboard.comment.content') }}:
            <br>{{ $comment->content }}
        </p>
        <form method="POST" action="{{ route('comment.remove') }}">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $comment->id }}">
            <input type="submit" class="btn btn-danger" value="{{ __('dashboard.comment.delete') }}">
        </form>
    </div>
</div>
