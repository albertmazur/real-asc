<div class="card mb-3">
    <h5 class="card-header">{{ __('app.ticket') }}</h5>
    <div class="card-body">
        <h5 class="card-title">{{ $ticket->event->name }}</h5>
        <p class="card-text">{{ __('app.date').' '. __('app.event') }}: {{ $ticket->event->date }} {{ $ticket->event->time }}<br>
        {{ __('app.date_purchase') }}: {{ $ticket->dateBuy }} {{ $ticket->timeBuy }}<br>
        {{$ticket->state}}<br>
        <span class="h6">{{ __('app.price') }}: {{ $ticket->event->price }}</span></p>
        @if ($option)
            <div class="d-flex flex-row">
                <form class="m-1" method="POST" action="{{ route("ticket.back") }}">
                    @method("put")
                    @csrf
                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                    <input type="submit" class="btn btn-danger" value="{{ __('app.return') }}">
                </form>
                <button class="btn btn-secondary m-1">{{ __('app.print') }}</button>
            </div>
        @endif
    </div>
</div>