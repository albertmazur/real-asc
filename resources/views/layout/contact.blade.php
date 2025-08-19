@extends('layout.app')

@section('content')
    @include('layout.parts.errors')
    <div class="container mt-5">
        <h1 class="mt-5">{{ __('app.contact.title') }}</h1>
        <p>{{ __('app.contact.intro') }}</p>

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('app.contact.form.name_label') }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('app.contact.form.name_placeholder') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('app.contact.form.email_label') }}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('app.contact.form.email_placeholder') }}">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">{{ __('app.contact.form.message_label') }}</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="{{ __('app.contact.form.message_placeholder') }}"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('app.contact.form.button') }}</button>
        </form>
    </div>
@endsection
