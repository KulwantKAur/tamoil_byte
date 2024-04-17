@extends("layouts.app")

@section("title", "Mehrpaket Sendung")

@section("content")
    <div class="main-container pt-2 pb-2" id="invoice">
        <div class="input-box quality">
            <label class="page-title" for="scan"><span class="bold-text">Mehrpaket Sendung</span>
            </label>
            <input id="scan" type="text" class="d-block" autofocus oninput="handleChangeMultibox(event)">
            <p class="grey">Scanne den Auftrag</p>
        </div>
        <a href="/">
            <button class="btn btn-warning mt-2 back">< Zurück</button>
        </a>
		{{-- <a href="/quality">
            <button class="main-btn mt-2 back">Einzelpaket Sendung</button>
        </a> --}}
    </div>
@endsection
