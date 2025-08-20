@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('stadium.index') }}" method="EGT">
            <div class="mb-3">
                <label for="nameSearch" class="form-label">{{ __('app.find') }}</label>
                <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="{{ __('app.enter_name') }}" value="{{ $nameSearch ?? '' }}">
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
                        <th>{{ __('app.name_user') }}</th>
                        <th>{{ __('app.role') }}</th>
                        <th>{{ __('app.e_mail') }}</th>
                        <th>{{ __('app.tel') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                @endsection
            </thead>
            @yield('headerTable')
            <tbody>
                @foreach($users as $user)
                    <tr style="height: 55px;">
                        <td>{{ $loop->iteration+($users->currentPage()-1)*$loop->count }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->tel }}</td>
                        <td>
                            @if ($user->id != Auth::id())
                                <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                                    <a class="btn btn-secondary" href="{{ route('user.edit', ['userId' => $user->id]) }}">{{ __('app.edit') }}</a>
                                    <form action="{{ route('user.delete') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="userId" value="{{ $user->id }}" />
                                        <button type="submit" class="btn btn-danger button-delete-user">{{ __('app.remove') }}</button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @yield('headerTable')
            </tfoot>
        </table>
    </div>
    @include('dashboard.admin.user.modal')
    @vite('resources/js/modalUser.js')
    <div class="d-flex justify-content-center">{{ $users->links() }}</div>
    <div class="mt-3">
        <h4>{{ __('dashboard.user.add') }}</h4>
        @include('dashboard.admin.user.form', ['user' => null])
    </div>
@endsection