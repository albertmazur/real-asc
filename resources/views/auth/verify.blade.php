@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('app.verify.verify_e_mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('app.verify.new_link') }}
                        </div>
                    @endif

                    {{ __('app.verify.text') }}
                    {{ __('app.verify.not_send_e_mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('app.verify.click') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
