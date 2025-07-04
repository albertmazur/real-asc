<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.ico') }}" alt="Logo" width="50" />
        </a>
        <a class="nav-link" href="{{ route('event.index') }}">{{ __('app.events') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('app.nav_toggle') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @use('App\Enums\Language')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lang.switch', Language::EN->value) }}">
                        <img width="25" src="{{ asset('images/gb.svg') }}" alt="{{ __('app.lang.en') }}"/>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lang.switch', Language::PL->value) }}">
                        <img width="25" src="{{ asset('images/pl.svg') }}" alt="{{ __('app.lang.pl') }}"/>
                    </a>
                </li>

                @guest
                    @if(Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('app.login_in') }}</a>
                        </li>
                    @endif

                    @if(Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('app.sign_up') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}">{{ __('app.dashboard') }}</a>
                            <a class="dropdown-item" href="{{ route('user.settings') }}">{{ __('app.setting') }}</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('app.login_out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>