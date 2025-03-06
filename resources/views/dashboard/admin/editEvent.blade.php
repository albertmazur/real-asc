@extends('dashboard.main')
@section('dashboard.content')
    @include("elemnts.errors")
        <h4>{{ __('dashboard.event.edit') }}</h4>
        <form action="{{ route("event.update") }}" method="post">
            @method("put")
            @csrf
            <input type="hidden" name="id" value="{{ $event->id }}" />
            <div class="mb-3">
                <label for="stadium_id" class="form-label">{{ __('app.stadium') }}</label>
                <select name="stadium_id" class="form-select" aria-label="{{ __('dashboard.stadium.choose') }}">
                    @foreach ($stadiums as $stadium)
                        <option @if ($stadium->id==$event->stadium_id) selected @endif value="{{$stadium->id}}">{{$stadium->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('app.name') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('app.description') }}</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ $event->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">{{ __('app.date') }}</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}">
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">{{ __('app.number_building') }}</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ substr($event->time, 0, 5) }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">{{ __('app.price') }}</label>
                <input type="number" min="0" step="0.01" class="form-control" id="price" name="price" value="{{ $event->price }}">
            </div>
            <button type="submit" class="btn btn-primary  me-auto">{{ __('app.save_changes') }}</button>
        </form>
@endsection
