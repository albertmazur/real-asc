@extends('dashboard.main')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ __('dashboard.ticket.verification') }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <div id="qr-reader" data-check-url="{{ route('ticket.verify') }}"></div>
                        <div id="qr-result" class="d-none alert mt-2 alert-dismissible fade show" role="alert">
                            <span id="qr-message"></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('app.close') }}"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.lang = {
            ticket_valid: @json(__('dashboard.ticket.valid')),
            ticket_invalid: @json(__('dashboard.ticket.xinvalid')),
            ticket_error: @json(__('dashboard.ticket.error')),
            camera_error: @json(__('dashboard.ticket.camera_error')),
        }
    </script>
    @vite('resources/js/scannerQr.js')
@endsection
