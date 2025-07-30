@extends('dashboard.main')

@section('dashboard.content')
    <h4>{{ __('dashboard.user.edit') }}</h4>
    @include('dashboard.admin.user.form', ['user' => $user])
@endsection
