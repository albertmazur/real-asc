@extends('layout.app')

@section('content')
    @include('elemnts.errors')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{ $event->name }}</h1>
        </div>
        <div class="card-body">
            <h4 class="text-center">{{ $event->date }} {{ $event->time }}</h4>
            <p class="text-center">{{ $event->description }}</p>
            <div class="mt-2">
                <p class="text-center">{{ __('app.stadium') }}: {{ $event->stadium->name }}</p>
                <p class="text-center">{{ __('app.address') }}: {{ $event->stadium->city }} {{ __('app.st') }} {{ $event->stadium->street }}, {{ $event->stadium->numberBuilding }}</p>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div>
            @if($event->date>$dateNotBuy && Auth::user()->role === 'client')
                @auth
                    <h4>{{ __('app.buy_ticket') }}</h4>
                    <h5>{{ __('app.price') }} <span id="priceEvent">{{ $event->price }}</span></h5>
                    <p>{{ __('app.free_places') }}: {{ $set = $event->stadium->places-$event->tickets->count() }}</p>
                    <form method="POST" action="{{ route('ticket.store') }}" class="" id="payment-form">
                        @csrf
                        <div id="card-element"></div>
                        <input type="hidden" name="payment_method" id="payment-method">
                        <div style="width: 13rem" class="col-auto input-group mb-3">
                            <input type="number" id="countTickets" name="countTickets" min="0" max="{{ $set }}" step="1" class="form-control" placeholder="{{ __('app.count_ticket') }}" aria-label="{{ __('app.count_ticket') }}" aria-describedby="button-addon2" >
                            <button class="btn btn-primary" type="submit" id="button-addon2">{{ __('app.buy') }}</button>
                          </div>
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                    </form>
                    <h5>{{ __('app.sum') }}: <span id="sumPrice">0.00</span></h5>
                @else
                    <h4>{{ __('app.no_account_ticket') }}</h4>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __('app.login_in') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __('app.sign_up') }}</a>
                @endauth
            @else
                <h4>{{ __('app.no_buy_ticket') }}</h4>
            @endif
        </div>

        <h4 class="mt-3">{{ __('app.comments') }}</h4>
        <div style="height: 35vh" class="overflow-auto">
            @foreach($event->commentsSort() as $comment)
            <div class="card m-2">
                <div class="card-body">
                  <h5 class="card-title">{{ $comment->user->name}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{ $comment->date }} {{ $comment->time }}</h6>
                  <p class="card-text">{{ $comment->content }}</p>
                  <button class="reportButton btn btn-danger" value="{{ $comment->id }}">{{ __('app.submission_comment') }}</button>
                </div>
              </div>
            @endforeach
        </div>

        <div class="mt-3">
            @guest
                <h4>{{ __('app.no_account_comment') }}</h4>
                <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __( 'app.login_in') }}</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __('app.sign_up') }}</a>
            @else
                <h4>{{ __('app.comment_add') }}</h4>
                <form method="POST" action="{{ route('comment.store') }}" class="row g-2">
                    @csrf
                      <div class="mb-3">
                        <label for="content" class="form-label">{{ __('app.description') }}</label>
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                      </div>
                      <input type="hidden" name="event_id" value="{{ $event->id}} ">
                      <input class="btn btn-primary" type="submit" value="{{ __('app.add') }}">
                </form>
            @endguest
        </div>
        <div style="display: none" id="registrationComment" class="mt-3">
            <h4>{{ __('app.submission_comment') }}</h4>
            <form method="POST" action="{{ route('submission.store') }}" class="row g-2">
                @csrf
                <select name="forWhat" class="form-select" aria-label="{{ __('app.registration') }}">
                    <option selected value="obrażliwe">{{ __('dashboard.comment.offensive') }}</option>
                    <option value="wulgarne">{{ __('dashboard.comment.vulgar') }}</option>
                    <option value="inne">{{ __('dashboard.comment.other') }}</option>
                </select>
                <div class="mb-3">
                    <label for="content" class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                <input type="hidden" id="comment_id" name="comment_id">
                <input class="btn btn-primary" type="submit" value="{{ __('app.add') }}">
            </form>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{ config('services.stripe.key') }}");

    async function setupStripe() {
        const response = await fetch("{{ route('ticket.create-payment-intent') }}");
        const { clientSecret } = await response.json();

        const elements = stripe.elements({ clientSecret });
        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");

        document.getElementById("payment-form").addEventListener("submit", async function(event) {
            event.preventDefault();
            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: { return_url: "{{ route('ticket.payment.status') }}" },
            });

            if (error) alert(error.message);
        });
    }

    setupStripe();
</script>
✅ Podsu
@endsection
