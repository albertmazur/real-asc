<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="albertmazur.pl" target="_blank" class="mb-3 me-3 mb-md-0 text-body-secondary text-decoration-none lh-1">
              <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <a href="https://www.albertmazur.pl" target="_blank" class="link-secondary mb-3 mb-md-0" rel="nofollow" >© 2025 Albert Mazur</a>
    </div>
    <nav>
        <a class="btn" href="{{ route('event.index') }}">{{ __('app.events') }}</a>
        <a class="btn" href="{{ route('stadium.list') }}">{{ __('app.club_facilities') }}</a>
        <a class="btn" href="{{ route('about') }}">{{ __('app.about.title') }}</a>
        <a class="btn" href="{{ route('contact') }}">{{ __('app.contact.title') }}</a>
    </nav>
    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex me-3">
        <li class="ms-3">
            <a href="https://x.com" target="_blank" class="icon text-body-secondary">
                <i class="bi bi-twitter-x fs-3"></i>
            </a>
        </li>
        <li class="ms-3">
            <a href="https://www.instagram.com" target="_blank" class="icon text-body-secondary">
                <i class="bi bi-instagram fs-3"></i>
            </a>
        </li>
        <li class="ms-3">
            <a href="https://www.facebook.com" target="_blank" class="icon text-body-secondary">
                <i class="bi bi-facebook fs-3"></i>
            </a>
        </li>
    </ul>
</footer>