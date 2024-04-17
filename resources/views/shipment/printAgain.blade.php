@extends("layouts.app")

@section("title", "Print Label again")

@section("content")

    <div class="main-container pt-2 pb-2" id="invoice">
        <div class="input-box quality">
            <label class="page-title" for="scan">Nochmals drucken: <span class="bold-text">Shipping Label</span>
            </label>
            <input id="scan" type="text" class="d-block" autofocus oninput="checkInvoiceNumberAgainPrinting(event)">
            <p class="grey">Zum drucken: Scanne den Auftrag</p>
        </div>
        <a href="/">
            <button class="btn btn-warning text-dark btn-lg mt-2 back"> Zurück</button>
        </a>
    </div>

@endsection
@push('scripts')

@endpush
