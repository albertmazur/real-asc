@extends('layout.app')

@section('content')
    @include('layout.parts.errors')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{ $event->name }}</h1>
        </div>
        <div class="card-body">
            @if($event->image)
                <div class="text-center mb-4">
                    <img src="{{ Storage::url($event->image) }}" class="img-fluid rounded" alt="{{ $event->name }}" style="max-height: 400px;">
                </div>
            @endif

            <h4 class="text-center">{{ $event->date }} {{ $event->time }}</h4>
            <p class="text-center">{{ $event->description }}</p>
            <div class="mt-2">
                <p class="text-center">{{ __('app.stadium') }}: {{ $event->stadium->name }}</p>
                <p class="text-center">{{ __('app.address') }}: {{ $event->stadium->city }} {{ __('app.st') }} {{ $event->stadium->street }}, {{ $event->stadium->numberBuilding }}</p>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="ticket-purchase-section p-4 bg-light rounded-3 shadow-sm mb-4 mx-5">
            @if($event->date>$dateNotBuy && isset(Auth::user()->role) && Auth::user()->role === $userRoleClient)
                @auth
                    <div class="ticket-info mb-4">
                        <h4 class="text-primary mb-3">{{ __('app.buy_ticket') }}</h4>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="fw-bold mb-0">{{ __('app.price') }}: <span id="priceEvent" class="text-primary">{{ $event->price }}</span> zł</h5>
                            <span class="badge bg-info text-dark">{{ __('app.free_places') }}: {{ $event->freePlaces() }}</span>
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

        <h4 class="mt-3">{{ __('app.comments') }}</h4>
        <div style="max-height: 35vh" class="overflow-auto mb-5">
            @foreach($event->commentsSort() as $comment)
                <div class="card m-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $comment->date }} {{ $comment->time }}</h6>
                        <p class="card-text">{{ $comment->content }}</p>
                        <button class="reportButton btn btn-danger" value="{{ $comment->id }}">{{ __('app.submission_comment') }}</button>
                    </div>
                </div>
            @endforeach
        </div>
        @auth
            <div id="registrationComment" class="mt-3 mb-5 d-none">
                <h4>{{ __('app.submission_comment') }}</h4>
                <form method="POST" action="{{ route('submission.store') }}">
                    @csrf
                    <select name="reason" class="form-select" aria-label="{{ __('app.registration') }}">
                        <option selected value="offensive">{{ __('dashboard.comment.offensive') }}</option>
                        <option value="vulgar">{{ __('dashboard.comment.vulgar') }}</option>
                        <option value="other">{{ __('dashboard.comment.other') }}</option>
                    </select>
                    <div class="mb-3">
                        <label for="content" class="form-label">{{ __('app.description') }}</label>
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                    </div>
                    <input type="hidden" id="comment_id" name="comment_id">
                    <input class="btn btn-primary" type="submit" value="{{ __('app.add') }}">
                </form>
            </div>
        @endauth

        <div class="mt-3">
            @guest
                <h4>{{ __('app.no_account_comment') }}</h4>
                <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __( 'app.login_in') }}</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __('app.sign_up') }}</a>
            @else
                <h4>{{ __('app.comment_add') }}</h4>
                <form method="POST" action="{{ route('comment.store') }}">
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
        <div id="registrationComment" class="mt-3 d-none">
            <h4>{{ __('app.submission_comment') }}</h4>
            <form method="POST" action="{{ route('submission.store') }}">
                @csrf
                @foreach($reasons as $reason)
                    <option value="{{ $reason->value }}" 
                        {{ (old('reason') == $reason->value) ? 'selected' : '' }}>
                        {{ __('dashboard.comment.' . strtolower($reason->name)) }}
                    </option>
                @endforeach
                <div class="mb-3">
                    <label for="content" class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                <input type="hidden" id="comment_id" name="comment_id">
                <input class="btn btn-primary" type="submit" value="{{ __('app.add') }}">
            </form>
        </div>
    </div>
    @include('event.script')
@endsection
