@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('stadium.index') }}" method="EGT">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('app.find') }}</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('app.enter_name') }}" value="{{ $name ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary me-auto">{{ __('app.find') }}</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped text-center">
            <thead>
                @section('headerTable')
                    <tr>
                        <th>{{ __('app.lp') }}</th>
                        <th>{{ __('app.name') }}</th>
                        <th>{{ __('app.address') }}</th>
                        <th>{{ __('app.free_places') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                @endsection
            </thead>
            @yield('headerTable')
            <tbody>
                @foreach($stadiums as $stadium)
                    <tr>
                        <td>{{ $loop->iteration+($stadiums->currentPage()-1)*$loop->count }}</td>
                        <td>{{ $stadium->name }}</td>
                        <td>{{ $stadium->city }}, ul.{{ $stadium->street }} {{ $stadium->numberBuilding }}</td>
                        <td>{{ $stadium->places }}</td>
                        <td><a class="btn btn-secondary" role="button" href="{{ route('stadium.edit', ['stadiumId' => $stadium->id]) }}">{{ __('app.edit') }}</a></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @yield('headerTable')
            </tfoot>
        </table>
    </div>
    <div class="d-flex justify-content-center">{{ $stadiums->links() }}</div>
    <div class="mt-3">
        <h4>{{ __('dashboard.stadium.add') }}</h4>
        @include('dashboard.admin.stadium.form', ['stadium' => null])
    </div>
@endsection
