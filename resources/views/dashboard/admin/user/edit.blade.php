@extends('dashboard.main')

@section('dashboard.content')
    @include('layout.parts.errors')
    <h4>{{ __('dashboard.user.edit') }}</h4>
    @include('dashboard.admin.user.form', ['user' => $user])
@endsection
