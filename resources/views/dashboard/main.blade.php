@extends('layouts.app')

@section('content')
    @if (Auth::user()->role === "admin") @include("dashboard.admin.nav")
    @elseif (Auth::user()->role === "moderator") @include("dashboard.moderator.nav")
    @elseif (Auth::user()->role === "client") @include("dashboard.client.nav")
    @endif

    @hasSection('dashboard.content')
        @yield('dashboard.content')
    @else
        <h1 class="text-center">{{ __("Witam w panelu") }} {{ config('app.name', 'Club') }}</h1>
    @endif
@endsection
