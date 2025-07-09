@extends('layout.app')

@section('content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('event.index') }}" method="GET">
            <div class="mb-3">
                <label for="nameSearch" class="form-label">{{ __('app.find') }}</label>
                <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="{{ __('app.enter_name') }}" value="{{ $nameSearch ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="sortSearch" class="form-label">{{ __('app.sort') }}</label>
                <select name="sortSearch" class="form-select" aria-label="{{ __('dashboard.sort_choice') }}">
                    <option @if($sortSearch == 'name') selected @endif value="name">{{ __('app.name') }}</option>
                    <option @if($sortSearch == 'date') selected @endif value="date">{{ __('app.date') }}</option>
                    <option @if($sortSearch == 'freeSet') selected @endif value="freeSet">{{ __('app.free_places') }}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('app.find') }}</button>
        </form>
    </div>
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($events as $event)
                @include('event.card')
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">{{ $events->links() }}</div>
@endsection
