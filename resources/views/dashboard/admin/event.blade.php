@extends('dashboard.main')

@section('dashboard.content')
    @include("elemnts.errors")
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
            <form action="{{ route("event.dashboard") }}" method="get">
                <div class="mb-3">
                    <label for="nameSearch" class="form-label">{{ __('app.find') }}</label>
                    <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="{{ __('app.enter_name') }}" value="{{ $nameSearch ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="sortSearch" class="form-label">{{ __('app.sort') }}</label>
                    <select name="sortSearch" class="form-select" aria-label="{{ __('dashboard.sort_choice') }}">
                        <option @if ($sortSearch=="name") selected @endif value="name">{{ __('app.name') }}</option>
                        <option @if ($sortSearch=="date") selected @endif value="date">{{ __('app.date') }}</option>
                        <option @if ($sortSearch=="freeSet") selected @endif value="freeSet">{{ __('app.free_places') }}</option>
                        <option @if ($sortSearch=="price") selected @endif value="price">{{ __('app.price') }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('app.find') }}</button>
            </form>
            </div>
                <table class="table table-striped">
                    <thead>
                        @section("headerTable")
                        <tr>
                            <th>{{ __('app.lp') }}</th>
                            <th>{{ __('app.name') }}</th>
                            <th>{{ __('app.date') }}</th>
                            <th>{{ __('app.free_places') }}</th>
                            <th>{{ __('app.price') }}</th>
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
                                <td><a class="btn btn-info" role="button" href="{{ route("event.edit", ["eventId" =>$event->id]) }}">{{ __('app.edit') }}</a></td>
                                <td><a class="btn btn-secondary" role="button" href="{{ route("event.show", ["eventId" =>$event->id]) }}">{{ __('app.details') }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @yield("headerTable")
                    </tfoot>
                </table>
        <div class="d-flex justify-content-center">{{ $events->links() }}</div>
        <div>
            <h4>{{ __('dashboard.event.add') }}</h4>
            <form action="{{ route("event.store") }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="stadium_id" class="form-label">{{ __('app.stadium') }}</label>
                    <select name="stadium_id" class="form-select" aria-label="{{ __('dashboard.stadium.choose') }}">
                        @foreach ($stadiums as $stadium)
                            <option @if($loop->iteration==1) selected @endif value="{{ $stadium->id }}">{{ $stadium->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('app.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">{{ __('app.day') }}</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">{{ __('app.hour') }}</label>
                    <input type="time" class="form-control" id="time" name="time">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">{{ __('app.price') }}</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price">
                </div>
                <button type="submit" class="btn btn-primary  me-auto">{{ __('app.add') }}</button>
            </form>
        </div>
@endsection
