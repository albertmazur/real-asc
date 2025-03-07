@if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show ms-2 me-2" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('app.close') }}"></button>
    </div>
  @endif

@if($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show ms-2 me-2" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('app.close') }}"></button>
    </div>
@endif
