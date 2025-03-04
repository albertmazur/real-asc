<div class="card m-2" style="width: 18rem;">
        <a class="nav-link" href="{{ route("event.show", $event->id) }}">
        <div class="card-body">
            <h2 class="card-title mb-3">{{ $event->name }}</h2>
                <p class="card-text">
                    {{ __("Data") }}: {{ $event->date }} {{ $event->time }}<br>
                    {{ __("Stadion") }}: {{ $event->stadium->name }}
                </p>
        </div>
    </a>
</div>

