@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('comment.index') }}" method="get">
            <div class="mb-3">
                <label for="contentSearch" class="form-label">{{ __('app.find') }}</label>
                <input type="text" id="contentSearch" name="contentSearch" class="form-control" placeholder="{{ __('app.enter_description') }}" value="{{ $nameSearch ?? '' }}">
              </div>
              <div class="mb-3">
                <label for="sortWhoSearch" class="form-label">{{ __('app.user') }}</label>
                <select name="sortWhoSearch" class="form-select" aria-label="{{ __('dashboard.user.select') }}">
                    <option @if ($sortWhoSearch== -2) selected @endif value="-2">{{ __('app.all') }}</option>
                    @foreach ($users as $user)
                        <option @if ($sortWhoSearch==$user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="sortEventSearch" class="form-label">{{ __('app.event') }}</label>
                <select name="sortEventSearch" class="form-select" aria-label="{{ __('dashboard.event.select') }}">
                    <option @if ($sortEventSearch== -2) selected @endif value="-2">{{ __('app.all') }}</option>
                    @foreach ($events as $event)
                        <option @if ($sortEventSearch==$event->id) selected @endif value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('app.find') }}</button>
        </form>
    </div>
    <div style="height: 40vh" class="overflow-auto">
        @foreach ($comments as $comment)
            @include("dashboard.comment.cardComment")
        @endforeach
    </div>
@endsection
