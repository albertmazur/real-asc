@extends('layout.app')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center mt-5 text-center">
    <h1 class="display-1 fw-bold text-danger">@yield('code', '404')</h1>
    <h2 class="mb-4 text-muted">@yield('message', __('error.default_message'))</h2>
    <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2">{{ __('error.back_home') }}</a>
</div>
@endsection
