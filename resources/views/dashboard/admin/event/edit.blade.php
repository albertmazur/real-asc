@extends('dashboard.main')

@section('dashboard.content')
    <h4>{{ __('dashboard.event.edit') }}</h4>
    @include('dashboard.admin.event.form', ['event' => $event, 'stadiums' => $stadiums])
@endsection
