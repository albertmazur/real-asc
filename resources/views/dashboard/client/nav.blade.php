<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('app.nav_toggle') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket.index') }}">{{ __('dashboard.ticket.my') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket.history') }}">{{ __('dashboard.ticket.history') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comment.my') }}">{{ __('dashboard.comment.my') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
