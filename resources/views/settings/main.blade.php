@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">{{ __('settings.header') }}</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist">
                    <a class="nav-link active" data-bs-toggle="pill" href="#profile">
                        {{ __('settings.profile_details') }}
                    </a>
                    <a class="nav-link" data-bs-toggle="pill" href="#email">
                        {{ __('settings.change_email') }}
                    </a>
                    <a class="nav-link" data-bs-toggle="pill" href="#password">
                        {{ __('settings.change_password') }}
                    </a>
                    <a class="nav-link text-danger" data-bs-toggle="pill" href="#delete-account">
                        {{ __('settings.delete_account') }}
                    </a>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profile">
                        @include('settings.profile')
                    </div>
                    <div class="tab-pane fade" id="email">
                        @include('settings.email')
                    </div>
                    <div class="tab-pane fade" id="password">
                        @include('settings.password')
                    </div>
                    <div class="tab-pane fade" id="delete-account">
                        @include('settings.delete-account')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection