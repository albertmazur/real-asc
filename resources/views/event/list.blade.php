@extends('layout.app')

@section('content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('event.index') }}" method="GET">
            <div class="mb-3">
                <label for="value" class="form-label">{{ __('app.find') }}</label>
                <input type="text" id="value" name="value" class="form-control" placeholder="{{ __('app.enter_name') }}" value="{{ $value ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="stadium" class="form-label">{{ __('app.stadium') }}</label>
                <select id="facility" name="facility" class="form-select" aria-label="{{ __('dashboard.sort_choice') }}">
                    <option value="0" {{ $facility == 0 ? 'selected' : '' }}>{{ __('app.all') }}</option>
                    @foreach ($stadiums as $stadium)
                        @dump($facility == $stadium->id)
                        <option value="{{ $stadium->id }}" {{ $facility == $stadium->id ? 'selected' : '' }}>{{ $stadium->name }}</option>
                    @endforeach
                </select>
            </div>
            <label for="sortSearch" class="form-label">{{ __('app.sort') }}</label>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">{{ __('app.sort') }}</span>
                    <select id="sortSearch" name="sortSearch" class="form-select" aria-label="{{ __('dashboard.sort_choice') }}">
                        <option value="name" {{ $sortSearch == 'name' ? 'selected' : '' }}>{{ __('app.name') }}</option>
                        <option value="date" {{ $sortSearch == 'date' ? 'selected' : '' }}>{{ __('app.date') }}</option>
                        <option value="freeSet" {{ $sortSearch == 'freeSet'? 'selected' : '' }}>{{ __('app.free_places') }}</option>
                    </select>
                    <select id="sortDirection" name="sortDirection" class="form-select" aria-label="{{ __('app.sort_direction') }}">
                        <option value="asc"  {{ $sortDirection == 'asc' ? 'selected' : '' }}>{{ __('app.asc') }}</option>
                        <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>{{ __('app.desc') }}</option>
                    </select>
                </div>
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
