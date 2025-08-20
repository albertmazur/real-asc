@extends('dashboard.main')

@section('dashboard.content')
    <h4>{{ __('dashboard.stadium.edit') }}</h4>
    @include('dashboard.admin.stadium.form', ['stadium' => $stadium])
@endsection
