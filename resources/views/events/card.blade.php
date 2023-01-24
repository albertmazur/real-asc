<div class="card m-3" style="width: 18rem;">
        <a class="nav-link" href="{{route("event.show", $event->id)}}">
        <div class="card-body">
            <h2 class="card-title mb-3">{{$event->name}}</h2>
                <p class="card-text">
                    Data: {{$event->date}} {{$event->time}}<br>
                    Stadion: {{$event->stadium->name}}
                </p>
        </div>
    </a>
</div>

