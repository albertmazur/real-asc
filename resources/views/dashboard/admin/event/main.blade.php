@extends('dashboard.main')

@section('dashboard.content')
    @include('layout.parts.errors')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('event.dashboard') }}" method="GET">
            <div class="mb-3">
                <label for="nameSearch" class="form-label">{{ __('app.find') }}</label>
                <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="{{ __('app.enter_name') }}" value="{{ $nameSearch ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="sortSearch" class="form-label">{{ __('app.sort') }}</label>
                <select name="sortSearch" class="form-select" aria-label="{{ __('dashboard.sort_choice') }}">
                    <option @if($sortSearch == 'name') selected @endif value="name">{{ __('app.name') }}</option>
                    <option @if($sortSearch == 'date') selected @endif value="date">{{ __('app.date') }}</option>
                    <option @if($sortSearch == 'freeSet') selected @endif value="freeSet">{{ __('app.free_places') }}</option>
                    <option @if($sortSearch == 'price') selected @endif value="price">{{ __('app.price') }}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('app.find') }}</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                @section('headerTable')
                    <tr>
                        <th>{{ __('app.lp') }}</th>
                        <th>{{ __('app.name') }}</th>
                        <th>{{ __('app.date') }}</th>
                        <th>{{ __('app.free_places') }}</th>
                        <th>{{ __('app.price') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                @endsection
            </thead>
            @yield('headerTable')
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $loop->iteration+(($events->currentPage()-1)*10) }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date }} {{ $event->time }}</td>
                        <td>{{ $event->freePlaces() }}</td>
                        <td>{{ $event->price }}</td>
                        <td>
                            <a class="btn btn-info" role="button" href="{{ route('event.edit', ['eventId' => $event->id]) }}">{{ __('app.edit') }}</a>
                            <a class="btn btn-secondary" role="button" href="{{ route('event.show', ['eventId' => $event->id]) }}">{{ __('app.details') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @yield('headerTable')
            </tfoot>
        </table>
    </div>
    <div class="d-flex justify-content-center">{{ $events->links() }}</div>
    <div>
        <h4>{{ __('dashboard.event.add') }}</h4>
        @include('dashboard.admin.event.form', ['event' => null, 'stadiums' => $stadiums])
    </div>
@endsection
