@extends('layout.app')

@section('content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        @include('event.form-search', ['route' => 'event.index'])   
    </div>
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($events as $event)
                @include('event.card')
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">{{ $events->links() }}</div>
@endsection
