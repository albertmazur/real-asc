<div class="card mb-4 shadow-sm border-0 rounded ticket">
    <h5 class="card-header bg-primary text-white">{{ __('app.ticket') }}</h5>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="card-title mb-2">{{ $ticket->event->name }}</h5>
                <p class="card-text text-muted mb-1">{{ __('app.date').' '. __('app.event') }}: <strong>{{ $ticket->event->date }} {{ $ticket->event->time }}</strong></p>
                <p class="card-text text-muted mb-1">{{ __('app.date_purchase') }}: <strong>{{ $ticket->dateBuy }} {{ $ticket->timeBuy }}</strong></p>
                <p class="card-text mb-1">{{ __('dashboard.ticket.' . $ticket->state) }}</p>
                <p class="card-text h6">{{ __('app.price') }}: <strong>{{ $ticket->event->price }}</strong></p>
                @if ($ticket->used_at)
                    <p class="text-danger">{{ __('ticket.used_at', ['date' => $ticket->used_at]) }}</p>
                @else
                    <p class="text-success">{{ __('ticket.not_used') }}</p>
                @endif
            </div>

            <div class="col-md-4 text-center">
                <div class="p-2">
                    {!! $ticket->qr_code !!}
                </div>
            </div>
        </div>

        @if($option)
            <div class="d-flex justify-content-center mt-3">
                <form method="POST" action="{{ route('ticket.back') }}" class="me-2 no-print">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                    <button type="submit" class="btn btn-outline-danger">{{ __('app.return') }}</button>
                </form>
                <button class="btn btn-outline-secondary buttonPrint no-print">{{ __('app.print') }}</button>
            </div>
        @endif
    </div>
</div>