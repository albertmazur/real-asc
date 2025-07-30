@use('App\Enums\UserRole;')
@extends('layout.app')

@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4 rounded">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('app.nav_toggle') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @if(Auth::user()->role === UserRole::ADMIN->value) @include('dashboard.admin.nav')
                    @elseif(Auth::user()->role === UserRole::MODERATOR->value) @include('dashboard.moderator.nav')
                    @elseif(Auth::user()->role === UserRole::USER->value) @include('dashboard.client.nav')
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @include('layout.parts.errors')
    @hasSection('dashboard.content')
        @yield('dashboard.content')
    @else
        <h1 class="text-center">{{ __('dashboard.welcome') }}</h1>
    @endif
@endsection
