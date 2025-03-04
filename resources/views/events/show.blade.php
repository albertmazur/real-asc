@extends('layouts.app')

@section('content')
    @include("elemnts.errors")
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{ $event->name }}</h1>
        </div>
        <div class="card-body">
            <h4 class="text-center">{{ $event->date }} {{ $event->time }}</h4>
            <p class="text-center">{{ $event->description }}</p>
            <div class="mt-2">
                <p class="text-center">{{ __("Stadion") }}: {{ $event->stadium->name }}</p>
                <p class="text-center">{{ __("Adres") }}: {{ $event->stadium->city }} ul.{{ $event->stadium->street }}, {{ $event->stadium->numberBuilding }}</p>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div>
            @if ($event->date>$dateNotBuy && Auth::user()->role==="client")
                @auth
                    <h4>{{ __("Kup bilet") }}</h4>
                    <h5>{{ __("Cena") }} <span id="priceEvent">{{ $event->price }}</span></h5>
                    <p>{{ __("Wolne miejsca") }}: {{ $set =(($event->stadium->places)-($event->tickets->count())) }}</p>
                    <form method="POST" action="{{ route("ticket.store") }}" class="row g-2">
                        @csrf
                        <div style="width: 13rem" class="col-auto input-group mb-3">
                            <input type="number" id="countTickets" name="countTickets" min="0" max="{{$set}}" step="1" class="form-control" placeholder="{{ __("Ilość biletów") }}" aria-label="{{ __("Ilość biletów") }}" aria-describedby="button-addon2" >
                            <button class="btn btn-primary" type="submit" id="button-addon2">{{ __("Kup") }}</button>
                          </div>
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                    </form>
                    <h5>{{ __("Suma") }} <span id="sumPrice">0.00</span></h5>
                @else
                    <h4>{{ __("Aby kupić bilet musisz mieć konto") }}</h4>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __("Zaloguj się") }}</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __("Zajerestruj się") }}</a>
                @endauth
            @else
                <h4>{{ __("Nie można już kupić biletów") }}</h4>
            @endif
        </div>

        <h4 class="mt-3">{{ __("Komentarze") }}</h4>
        <div style="height: 35vh" class="overflow-auto">
            @foreach ($event->commentsSort() as $comment)
            <div class="card m-2">
                <div class="card-body">
                  <h5 class="card-title">{{ $comment->user->name}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{ $comment->date }} {{ $comment->time }}</h6>
                  <p class="card-text">{{ $comment->content }}</p>
                  <button class="reportButton btn btn-danger" value="{{ $comment->id }}">{{ __("Zgłoś komentarz") }}</button>
                </div>
              </div>
            @endforeach
        </div>

        <div class="mt-3">
            @guest
                <h4>{{ __("Aby dodać komentarz musisz mieć konto") }}</h4>
                <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __( "Zaloguj się") }}</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __("Zajerestruj się") }}</a>
            @else
                <h4>{{ __("Dodaj komentarz") }}</h4>
                <form method="POST" action="{{ route("comment.store") }}" class="row g-2">
                    @csrf
                      <div class="mb-3">
                        <label for="content" class="form-label">{{ __("Opis") }}</label>
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                      </div>
                      <input type="hidden" name="event_id" value="{{ $event->id}} ">
                      <input class="btn btn-primary" type="submit" value="{{ __("Dodaj") }}">
                </form>
            @endguest
        </div>
        <div style="display: none" id="registrationComment" class="mt-3">
            <h4>{{ __("Zgłoś komentarz") }}</h4>
            <form method="POST" action="{{ route("submission.store") }}" class="row g-2">
                @csrf
                <select name="forWhat" class="form-select" aria-label="Registration">
                    <option selected value="obrażliwe">{{ __("Obrażliwe") }}</option>
                    <option value="wulgarne">{{ __("Wulgarne") }}</option>
                    <option value="inne">{{ __("Inne") }}</option>
                  </select>
                  <div class="mb-3">
                    <label for="content" class="form-label">{{ __("Opis") }}</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                  </div>
                  <input type="hidden" id="comment_id" name="comment_id">
                  <input class="btn btn-primary" type="submit" value="{{ __("Dodaj") }}">
            </form>
        </div>
    </div>
@endsection
