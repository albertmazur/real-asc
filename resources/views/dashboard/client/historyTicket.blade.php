@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('ticket.history') }}" method="GET">
            <div class="mb-3">
                <label for="event" class="form-label">{{ __('app.event') }}</label>
                <select name="event" class="form-select" aria-label="{{ __('dashboard.event.select') }}">
                    <option @if(!$event) selected @endif value="">{{ __('app.all') }}</option>
                    @foreach($events as $e)
                        <option @if($event == $e->id) selected @endif value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('app.find') }}</button>
        </form>
    </div>
    <div style="height: 40vh" class="overflow-auto">
        @foreach($tickets as $ticket)
            @include('dashboard.client.cardTicket')
        @endforeach
    </div>
@endsection
