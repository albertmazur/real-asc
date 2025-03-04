<div class="card mb-3">
    <h5 class="card-header">{{ __("Bilet") }}</h5>
    <div class="card-body">
        <h5 class="card-title">{{ $ticket->event->name }}</h5>
        <p class="card-text">{{ __("Data wydarzenia") }}: {{ $ticket->event->date }} {{ $ticket->event->time }}<br>
        {{ __("Data zakupy") }}: {{ $ticket->dateBuy }} {{ $ticket->timeBuy }}<br>
        {{$ticket->state}}<br>
        <span class="h6">{{ __("Cena") }}: {{ $ticket->event->price }}</span></p>
        @if ($option)
            <div class="d-flex flex-row">
                <form class="m-1" method="POST" action="{{ route("ticket.back") }}">
                    @method("put")
                    @csrf
                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                    <input type="submit" class="btn btn-danger" value="{{ __("Zwróć") }}">
                </form>
                <button class="btn btn-secondary m-1">{{ __("Drukuj") }}</button>
            </div>
        @endif
    </div>
</div>