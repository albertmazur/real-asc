@extends('dashboard.main')

@section('dashboard.content')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        <form action="{{ route("submission.index") }}" method="get">
            <div class="mb-3">
                <label for="contentSearch" class="form-label">{{ __("Szukaj") }}</label>
                <input type="text" id="contentSearch" name="contentSearch" class="form-control" placeholder="{{ __("Wpisz opis") }}" value="{{ $nameSearch ?? '' }}">
              </div>
              <div class="mb-3">
                <label for="sortSearch" class="form-label">Wybierz temat</label>
                <select name="sortSearch" class="form-select" aria-label="{{ __("Wybierz jaki to komentarz") }}">
                    <option @if ($sortSearch == "All") selected @endif  value="All">{{ __("Wszystkie") }}</option>
                    <option @if ($sortSearch == "Obrażliwe") selected @endif  value="Obrażliwe">{{ __("Obrażliwe") }}</option>
                    <option @if ($sortSearch == "Wulgarne") selected @endif value="Wulgarne">{{ __("Wulgarne") }}</option>
                    <option @if ($sortSearch == "Inne") selected @endif value="Inne">{{ __("Inne") }}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __("Szukaj") }}</button>
        </form>
    </div>
    <div style="height: 40vh" class="overflow-auto">
        @foreach ($submissions as $submission)
            @include("dashboard.submission.cardSubmission")
        @endforeach
    </div>
@endsection
