@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route("ticket.history") }}" method="get">
            <div class="mb-3">
                <label for="sortEventSearch" class="form-label">{{ __("Wydarzenie") }}</label>
                <select name="sortEventSearch" class="form-select" aria-label="{{ __("Wybierz wydarzenie") }}">
                    <option @if ($sortEventSearch== -2) selected @endif value="-2">{{ __("Wszyscy") }}</option>
                    @foreach ($events as $event)
                        <option @if ($sortEventSearch==$event->id) selected @endif value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __("Szukaj") }}</button>
        </form>
    </div>
    <div style="height: 40vh" class="overflow-auto">
        @foreach ($tickets as $ticket)
            @include("dashboard.client.cardTicket")
        @endforeach
    </div>
@endsection
