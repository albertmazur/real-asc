@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li class="d-flex align-items-start mb-1">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                    <span>{{ $error }}</span>
                </li>
            @endforeach
        </ul>
        <button type="button" class="btn-close top-50 translate-middle-y" data-bs-dismiss="alert" aria-label="{{ __('app.close') }}"></button>
    </div>
@endif
