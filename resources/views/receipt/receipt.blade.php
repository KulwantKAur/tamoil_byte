@extends("layouts.app")

@section("title", "Retourenmanagement")

@section("content")
    <div class="main-container pt-2 pd-2" id="invoice">
        <div class="input-box quality">

            <label class="page-title"  for="scan"><span class="bold-text">Retourenmanagement</span>
            </label>
            <input id="scan" type="text" class="d-block"  autofocus oninput="scanReturnHandler(event)">
            <p class="grey">Scanne das Retourenformular</p>
        </div>
           <div style="width:100%">
        <a href="/" style="float: right;">
            <button class="main-btn mt-2 back no-print"> Zurück</button>
        </a>
    </div>
    </div>
@endsection
