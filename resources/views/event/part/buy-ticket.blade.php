<div class="p-4 bg-body text-body rounded-3 border shadow-lg mb-4 mx-5">
    @if($event->date>$dateNotBuy && isset(Auth::user()->role) && Auth::user()->role === $userRoleClient)
        @auth
            <div class="ticket-info mb-4">
                <h4 class="text-primary mb-3">{{ __('app.buy_ticket') }}</h4>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold mb-0">{{ __('app.price') }}: <span id="priceEvent" class="text-primary">{{ $event->formatted_price }}</span> zł</h5>
                    <span class="badge bg-info text-body">{{ __('app.free_places') }}: {{ $event->freePlaces() }}</span>
                </div>
                <hr class="my-3">
            </div>
            <form method="POST" action="{{ route('ticket.store') }}" class="needs-validation" id="payment-form">
                @csrf
                <h4 class="mb-4 text-center">{{ __('event.form') }}</h4>

                <div class="mb-3">
                    <label for="card-number" class="form-label fw-bold p-0">{{ __('event.number_card') }}</label>
                    <div id="card-number" class="form-control py-3"></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="card-expiry" class="form-label fw-bold">{{ __('event.date') }}</label>
                        <div id="card-expiry" class="form-control py-3"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="card-cvc" class="form-label fw-bold">{{ __('event.cvc') }}</label>
                        <div id="card-cvc" class="form-control py-3"></div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="countTickets" class="form-label fw-bold">{{ __('app.count_ticket') }}</label>
                    <div class="input-group">
                        <input type="number" id="countTickets" name="countTickets" min="0" max="{{ $event->freePlaces() }}" step="1"
                            class="form-control" placeholder="{{ __('app.count_ticket') }}"
                            aria-label="{{ __('app.count_ticket') }}" aria-describedby="button-addon2">
                        <span class="input-group-text">szt.</span>
                    </div>
                </div>
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">{{ __('app.sum') }}: <span id="sumPrice" class="text-primary">0.00</span> zł</div>
                    <button class="btn btn-primary btn-lg px-4" type="submit" id="button-addon2">
                        <i class="bi bi-credit-card me-2"></i>{{ __('app.buy') }}
                    </button>
                </div>
            </form>
        @else
            <div class="text-center py-4">
                <h4 class="mb-4">{{ __('app.no_account_ticket') }}</h4>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('app.login_in') }}
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                        <i class="bi bi-person-plus me-2"></i>{{ __('app.sign_up') }}
                    </a>
                </div>
            </div>
        @endauth
    @else
        <div class="alert alert-warning text-center py-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-1 d-block mb-3"></i>
            <h4>{{ __('app.no_buy_ticket') }}</h4>
            <p class="mb-0 text-muted">{{ __('event.not_login') }}</p>
        </div>
    @endif
</div>