@extends('layout.app')

@section('content')
    <div class="container">
        <div class="main">
            <h1 class="text-center mb-4">{{ __('app.main.welcome_in_club') }} {{ config('app.name', 'Club') }}</h1>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/stadium/stadium1.webp') }}" class=" w-100 h-50 rounded object-fit-cover" alt="{{ __('app.stadium') }}">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/stadium/stadium2.webp') }}" class="d-block w-100 h-50 rounded object-fit-cover" alt="{{ __('app.stadium') }}">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/stadium/stadium3.webp') }}" class="d-block w-100 h-50 rounded object-fit-cover" alt="{{ __('app.stadium') }}">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('pagination.previous') }}</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('pagination.next') }}</span>
                </button>
            </div>
        </div>

        <div class="mt-4 pt-4 bg-body shadow-sm rounded">
            <h4 class="text-center text-body mb-5">{{ __('app.main.upcoming_events') }}</h4>
            <div class="row g-4 justify-content-center px-3">
                @foreach($closestTimeEvent as $event)
                    @include('event.card')
                @endforeach
            </div>
        </div>

        <div class="mt-4 pt-4 bg-body shadow-sm rounded">
            <h4 class="text-center text-body mb-5">{{ __('app.main.most_commented_events') }}</h4>
            <div class="row g-4 justify-content-center px-3">
                @foreach($mostComentEvent as $event)
                    @include('event.card')
                @endforeach
            </div>
        </div>
    </div>
@endsection
