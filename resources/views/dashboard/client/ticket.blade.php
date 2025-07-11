@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('ticket.index') }}" method="GET">
            <div class="mb-3">
                <label for="sortEventSearch" class="form-label">{{ __('app.event') }}</label>
                <select name="sortEventSearch" class="form-select" aria-label="{{ __('dashboard.event.select') }}">
                    <option @if($sortEventSearch == -2) selected @endif value="-2">{{ __('app.all') }}</option>
                    @foreach($events as $event)
                        <option @if($sortEventSearch == $event->id) selected @endif value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('app.find') }}</button>
        </form>
    </div>
    <div style="height: 55vh" class="overflow-auto">
        @foreach($tickets as $ticket)
            @if($ticket->event->date>$now)
                @include('dashboard.client.cardTicket')
            @endif
        @endforeach
    </div>
    <script>
        const cssUrl = @json(asset('css/app.css'));
        window.trans = {
            ticketNotFound: @json(__('app.ticket_not_found')),
            ticket: @json(__('app.ticket')),
        }
    </script>
    @vite(['resources/js/printTicket.js'])
@endsection
