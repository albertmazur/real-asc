@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1>{{ __('app.about.title') }}</h1>
        <p>{{ __('app.about.description1') }}</p>
        <p>{{ __('app.about.description2') }}</p>
        <p>{{ __('app.about.description3') }}</p>

        <h2 class="mt-5">{{ __('app.about.location_title') }}</h2>
        <p>{{ __('app.about.location_description') }}</p>
        <div class="ratio ratio-16x9 my-4">
            <iframe src="https://maps.google.com/maps?q=Estadio%20Santiago%20Bernabeu%2C%20Madrid%20Spain&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen loading="lazy" title="{{ __('app.about.map_title') }}"></iframe>
        </div>
    </div>
@endsection
