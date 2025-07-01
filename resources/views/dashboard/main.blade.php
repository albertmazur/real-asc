@use('App\Enums\UserRole;')
@extends('layout.app')

@section('content')
    @if(Auth::user()->role === UserRole::ADMIN->value) @include('dashboard.admin.nav')
    @elseif(Auth::user()->role === UserRole::MODERATOR->value) @include('dashboard.moderator.nav')
    @elseif(Auth::user()->role === UserRole::USER->value) @include('dashboard.client.nav')
    @endif

    @hasSection('dashboard.content')
        @yield('dashboard.content')
    @else
        <h1 class="text-center">{{ __('dashboard.welcome') }}</h1>
    @endif
@endsection
