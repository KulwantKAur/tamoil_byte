@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")

    <div class="main-container pt-2 pb-2" id="main-container" >
        <div class="input-box scanInvoiceNumberOrderRef">
            <label class="grey" for="scan">Rechnungsnummer oder Auftragsnummer eingeben:</span>
            </label>
            <input id="scanInvoiceNumberOrderRef" type="text" class="d-block" autofocus>
        </div>
        <div id="orderContent"></div>
        <div id="content_info" class="content_info reklaportal_content_info d-none"></div>
        <a href="{{ route('home_reklaportal') }}">
            <button class="btn  btn-outline-primary mt-2 back"> Zurück</button>
        </a>
    </div>

@endsection
