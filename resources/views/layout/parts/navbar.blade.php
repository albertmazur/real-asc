<nav class="navbar navbar-expand-md shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.ico') }}" alt="Logo" width="50" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('app.nav_toggle') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('event.index') }}">{{ __('app.events') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('stadium.list') }}">{{ __('app.club_facilities') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">{{ __('app.about.title') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">{{ __('app.contact.title') }}</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-link">
                    <input type="checkbox" class="dark-mode" id="dark-mode">
                    <label for="dark-mode" class="dark-mode-label">
                        <i class="bi bi-moon"></i>
                        <i class="bi bi-sun"></i>
                        <span class="ball"></span>
                    </label>
                </li>

                @use('App\Enums\Language')
                <li class="nav-link">
                    <a class="link-offset-2 link-underline link-underline-opacity-0 me-1" href="{{ route('lang.switch', Language::EN->value) }}">
                        <img width="25" src="{{ asset('images/gb.svg') }}" alt="{{ __('app.langs.en') }}"/>
                    </a>
                    <a class="link-offset-2 link-underline link-underline-opacity-0 ms-1" href="{{ route('lang.switch', Language::PL->value) }}">
                        <img width="25" src="{{ asset('images/pl.svg') }}" alt="{{ __('app.langs.pl') }}"/>
                    </a>
                </li>

                <!-- Authentication Links -->
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
                            <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('app.dashboard') }}</a>
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
    @vite('resources/js/darkMode.js')
</nav>