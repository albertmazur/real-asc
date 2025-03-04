@extends('dashboard.main')
@section('dashboard.content')
    @include("elemnts.errors")
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
            <form action="{{ route("stadium.index") }}" method="get">
                <div class="mb-3">
                    <label for="nameSearch" class="form-label">{{ __("Szukaj") }}</label>
                    <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="Wpisz nazwę" value="{{ $nameSearch ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary  me-auto">{{ __("Szukaj") }}</button>
            </form>
            </div>
                <table class="table table-striped">
                    <thead>
                        @section("headerTable")
                        <tr>
                            <th>{{ __("Lp") }}</th>
                            <th>{{ __("Nazwa") }}</th>
                            <th>{{ __("Adres") }}</th>
                            <th>{{ __("Pojemność") }}</th>
                            <th></th>
                        </tr>
                        @endsection
                    </thead>
                    @yield("headerTable")
                    <tbody>
                        @foreach ($stadiums as $stadium)
                            <tr>
                                <td>{{ $loop->iteration+($stadiums->currentPage()-1)*$loop->count }}</td>
                                <td>{{ $stadium->name }}</td>
                                <td>{{ $stadium->city }}, ul.{{ $stadium->street }} {{ $stadium->numberBuilding }}</td>
                                <td>{{ $stadium->places }}</td>
                                <td><a class="btn btn-secondary" role="button" href="{{ route("stadium.edit", ["stadiumId" =>$stadium->id]) }}">{{ __("Edytuj") }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @yield("headerTable")
                    </tfoot>
                </table>
        <div class="d-flex justify-content-center">{{ $stadiums->links() }}</div>
        <div class="mt-3">
            <h4>{{ __("Dodaj stadion") }}</h4>
            <form action="{{ route("stadium.store") }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __("Nazwa") }}</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">{{ __("Miasto") }}</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="mb-3">
                    <label for="street" class="form-label">{{ __("Ulica") }}</label>
                    <input type="text" class="form-control" id="street" name="street">
                </div>
                <div class="mb-3">
                    <label for="numberBuilding" class="form-label">{{ __("Numer budynku") }}</label>
                    <input type="text" class="form-control" id="numberBuilding" name="numberBuilding">
                </div>
                <div class="mb-3">
                    <label for="places" class="form-label">{{ __("Pojemność") }}</label>
                    <input type="number" min="0" step="1" class="form-control" id="size" name="places">
                </div>
                <button type="submit" class="btn btn-primary  me-auto">{{ __("Dodaj") }}</button>
            </form>
        </div>
@endsection
