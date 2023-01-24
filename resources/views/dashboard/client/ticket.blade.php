@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{route("ticket.index")}}" method="get">
            <div class="mb-3">
                <label for="sortEventSearch" class="form-label">Wydarzenie</label>
                <select name="sortEventSearch" class="form-select" aria-label="Default select example">
                    <option @if ($sortEventSearch== -2) selected @endif value="-2">Wszyscy</option>
                    @foreach ($events as $event)
                        <option @if ($sortEventSearch==$event->id) selected @endif value="{{$event->id}}">{{$event->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Szukaj</button>
        </form>
    </div>
    <div style="height: 55vh" class="overflow-auto">
        @foreach ($tickets as $ticket)
            @if ($ticket->event->date>$now)
                @include("dashboard.client.cardTicket")
            @endif
        @endforeach
    </div>
@endsection
