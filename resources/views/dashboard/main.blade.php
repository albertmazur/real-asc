@extends('layouts.app')

@section('content')
    @if (Auth::user()->role === "admin") @include("dashboard.admin.nav")
    @elseif (Auth::user()->role === "moderator") @include("dashboard.moderator.nav")
    @elseif (Auth::user()->role === "client") @include("dashboard.client.nav")
    @endif

    @yield('dashboard.content')
@endsection
