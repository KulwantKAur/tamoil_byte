@extends("layouts.app")

@section("title", "Qualitätskontrolle")

@section("content")
    <div class="main-container pt-2 pb-2" id="invoice">
        <div class="input-box quality">
          
            <input id="scan" type="text" class="d-block" autofocus oninput="handlegetCompleteEanProduct(event)">
            <p class="grey">Search EAN or name</p>
        </div>
        <a href="/">
            <button class="main-btn mt-2 back">< Zurück</button>
        </a>
    </div>

  
@endsection