@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('submission.index') }}" method="GET">
            <div class="mb-3">
                <label for="contentSearch" class="form-label">{{ __('app.find') }}</label>
                <input type="text" id="contentSearch" name="contentSearch" class="form-control" placeholder="{{ __('app.enter_description') }}" value="{{ $nameSearch ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="sortSearch" class="form-label">{{ __('dashboard.choose_topic') }}</label>
                <select name="sortSearch" class="form-select" aria-label="{{ __('dashboard.comment.which') }}">
                    <option @if($sortSearch == 'All') selected @endif  value="All">
                        {{ __('app.all') }}
                    </option>
                    @foreach(\App\Enums\ReasonSubmission::cases() as $reason)
                        <option value="{{ $reason->value }}" {{ $sortSearch === $reason->value ? 'selected' : '' }}>{{ __('dashboard.comment.' . $reason->value) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('app.find') }}</button>
        </form>
    </div>
    <div style="height: 40vh" class="overflow-auto">
        @foreach($submissions as $submission)
            @include('dashboard.submission.cardSubmission')
        @endforeach
    </div>
@endsection
