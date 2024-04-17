@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")

    <h2 class="reklaportal_title">Retourenportal</h2>
    <div class="reklaportal_content">
        <a href="{{route('service')}}">Neue Rucksendung</a>

    </div>
   <a href="/" >
            <button class="btn btn-outline-primary">Zurück</button>
        </a>
@endsection
