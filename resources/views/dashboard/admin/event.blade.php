@extends('dashboard.main')

@section('dashboard.content')
    @include("elemnts.errors")
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
            <form action="{{ route("event.dashboard") }}" method="get">
                <div class="mb-3">
                    <label for="nameSearch" class="form-label">{{ __("Szukaj") }}</label>
                    <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="{{ __("Wpisz nazwę") }}" value="{{ $nameSearch ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="sortSearch" class="form-label">{{ __("Sortuj") }}</label>
                    <select name="sortSearch" class="form-select" aria-label="{{ __("Wybierz po czym sortować") }}">
                        <option @if ($sortSearch=="name") selected @endif value="name">{{ __("Nazwie") }}</option>
                        <option @if ($sortSearch=="date") selected @endif value="date">{{ __("Data") }}</option>
                        <option @if ($sortSearch=="freeSet") selected @endif value="freeSet">{{ __("Wolne miejsca") }}</option>
                        <option @if ($sortSearch=="price") selected @endif value="price">{{ __("Cena") }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{ __("Szukaj") }}</button>
            </form>
            </div>
                <table class="table table-striped">
                    <thead>
                        @section("headerTable")
                        <tr>
                            <th>{{ __("Lp") }}</th>
                            <th>{{ __("Nazwa") }}</th>
                            <th>{{ __("Data") }}</th>
                            <th>{{ __("Wolne miejsca") }}</th>
                            <th>{{ __("Cena") }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @endsection
                    </thead>
                    @yield("headerTable")
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $loop->iteration+(($events->currentPage()-1)*10) }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->date }} {{ $event->time }}</td>
                                <td>{{ $event->freeSet }}</td>
                                <td>{{ $event->price }}</td>
                                <td><a class="btn btn-info" role="button" href="{{ route("event.edit", ["eventId" =>$event->id]) }}">{{ __("Edytuj") }}</a></td>
                                <td><a class="btn btn-secondary" role="button" href="{{ route("event.show", ["eventId" =>$event->id]) }}">{{ __("Szczegóły") }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @yield("headerTable")
                    </tfoot>
                </table>
        <div class="d-flex justify-content-center">{{ $events->links() }}</div>
        <div>
            <h4>{{ __("Dodaj wydarzenie") }}</h4>
            <form action="{{ route("event.store") }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="stadium_id" class="form-label">{{ __("Stadion") }}</label>
                    <select name="stadium_id" class="form-select" aria-label="{{ __("Wybierz stadion") }}">
                        @foreach ($stadiums as $stadium)
                            <option @if($loop->iteration==1) selected @endif value="{{$stadium->id}}">{{$stadium->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __("Nazwa") }}</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __("Opis") }}</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">{{ __("Dzień") }}</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">{{ __("Godzina") }}</label>
                    <input type="time" class="form-control" id="time" name="time">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">{{ __("Cena") }}</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price">
                </div>
                <button type="submit" class="btn btn-primary  me-auto">{{ __("Dodaj") }}</button>
            </form>
        </div>
@endsection
