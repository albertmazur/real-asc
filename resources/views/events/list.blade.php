@extends('layouts.app')

@section('content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{route("event.index")}}" method="get">
            <div class="mb-3">
                <label for="nameSearch" class="form-label">Szukaj</label>
                <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="Wpisz nazwę" value="{{$nameSearch ?? ''}}">
              </div>
              <div class="mb-3">
                <label for="sortSearch" class="form-label">Sortuj</label>
                <select name="sortSearch" class="form-select" aria-label="Default select example">
                    <option @if ($sortSearch=="name") selected @endif value="name">Nazwie</option>
                    <option @if ($sortSearch=="date") selected @endif value="date">Data</option>
                    <option @if ($sortSearch=="freeSet") selected @endif value="freeSet">Wolne miejsca</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Szukaj</button>
        </form>
        </div>
            <table class="table table-striped">
                <thead>
                    @section("headerTable")
                    <tr>
                        <th>Lp</th>
                        <th>Nazwa</th>
                        <th>Data</th>
                        <th>Wolne miejsca</th>
                        <th>Cena</th>
                        <th></th>
                    </tr>
                    @endsection
                </thead>
                @yield("headerTable")
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration+(($events->currentPage()-1)*10) }}</td>
                            <td>{{ $event->name}}</td>
                            <td>{{ $event->date}} {{ $event->time}}</td>
                            <td>{{ $event->freeSet}}</td>
                            <td>{{ $event->price}}</td>
                            <td><a class="btn btn-secondary" role="button" href="{{ route("event.show", ["eventId" =>$event->id])}}">Szczegóły</a></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @yield("headerTable")
                </tfoot>
            </table>
    <div class="d-flex justify-content-center">{{$events->links()}}</div>
@endsection
