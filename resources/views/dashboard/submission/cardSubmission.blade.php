<div class="card mb-4 shadow-sm">
    <h5 class="card-header">{{ __('app.submission') }}</h5>
    <div class="card-body">
        <div class="row">
            <!-- Lewa kolumna: Informacje o zgłoszeniu -->
            <div class="col-md-6 mb-3">
                <h6 class="text-muted">{{ __('dashboard.comment.' . $submission->reason) }}</h6>
                <p class="mb-2">
                    <strong>{{ __('dashboard.submission.content') }}:</strong><br>
                    {{ $submission->content }}
                </p>
            </div>

            <!-- Prawa kolumna: Powiązany komentarz -->
            <div class="col-md-6">
                @if ($submission->comment)
                    <p class="mb-2">
                        <strong>{{ __('dashboard.comment.event_name') }}:</strong><br>
                        {{ $submission->comment->event->name }}
                    </p>
                    <p class="mb-2">
                        <strong>{{ __('dashboard.comment.content') }}:</strong><br>
                        {{ $submission->comment->content }}
                    </p>
                @else
                    <p class="text-danger">
                        <strong>{{ __('dashboard.submission.not_comment') }}</strong>
                    </p>
                @endif
            </div>
        </div>

        <form method="POST" action="{{ route('submission.remove') }}" class="mt-3">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $submission->id }}">
            <button type="submit" class="btn btn-sm btn-danger">
                {{ __('dashboard.comment.delete_comments_submission') }}
            </button>
        </form>
    </div>
</div>
