@extends('layout.app')

@section('content')
    @if(Auth::user()->role === 'admin') @include('dashboard.admin.nav')
    @elseif(Auth::user()->role === 'moderator') @include('dashboard.moderator.nav')
    @elseif(Auth::user()->role === 'client') @include('dashboard.client.nav')
    @endif

    @hasSection('dashboard.content')
        @yield('dashboard.content')
    @else
        <h1 class="text-center">{{ __('dashboard.welcome') }}</h1>
    @endif
@endsection
