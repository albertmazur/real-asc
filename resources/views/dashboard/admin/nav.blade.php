<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4 rounded">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('app.nav_toggle') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.users') }}">{{ __('app.users') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stadium.*') ? 'active' : '' }}" href="{{ route('stadium.index') }}">{{ __('app.stadiums') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('event.*') ? 'active' : '' }}" href="{{ route('event.dashboard') }}">{{ __('app.events') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('submission.*') ? 'active' : '' }}" href="{{ route('submission.index') }}">{{ __('app.submissions') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('comment.*') ? 'active' : '' }}" href="{{ route('comment.index') }}">{{ __('app.comments') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
