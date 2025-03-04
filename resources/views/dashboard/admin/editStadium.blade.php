@extends('dashboard.main')
@section('dashboard.content')
    @include("elemnts.errors")
    <h4>{{ __("Edutuj stadion") }}</h4>
    <form action="{{ route("stadium.update") }}" method="post">
        @method("put")
        @csrf
        <input type="hidden" name="id" value="{{ $stadium->id }}" />
        <div class="mb-3">
            <label for="name" class="form-label">{{ __("Nazwa") }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $stadium->name }}">
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">{{ __("Miasto") }}</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $stadium->city }}">
          </div>
          <div class="mb-3">
            <label for="street" class="form-label">{{ __("Ulica") }}</label>
            <input type="text" class="form-control" id="street" name="street" value="{{ $stadium->street }}">
          </div>
          <div class="mb-3">
            <label for="numberBuilding" class="form-label">{{ __("Numer budynku") }}</label>
            <input type="text" class="form-control" id="numberBuilding" name="numberBuilding" value="{{ $stadium->numberBuilding }}">
          </div>
          <div class="mb-3">
            <label for="places" class="form-label">{{ __("Pojemność") }}</label>
            <input type="number" min="0" step="1" class="form-control" id="size" name="places" value="{{ $stadium->places }}">
          </div>
          <button type="submit" class="btn btn-primary  me-auto">{{ __("Zapisz zmiany") }}</button>
    </form>
</div>
@endsection
