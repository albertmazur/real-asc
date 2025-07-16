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
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('comment.*') ? 'active' : '' }}" href="{{ route('ticket.scanner') }}">{{ __('app.ticket') }}</a>
</li>

