@extends("layouts.app")

@section("title", "Qualitätskontrolle")

@section("content")
    <div class="main-container pt-2 pd-2" id="invoice">
@if ($user->labeldrucker=='9999'&& $user->a4drucker!='9999')
       <div class="alert alert-warning" role="alert">
  Es wurde noch kein Labeldrucker in den Druckereinstellungen ausgewählt bitte wählen Sie einen Drucker in den Einstellungen aus. <a href="admin/druckereinstellungen" class="alert-link"><button class="btn btn-info"><strong>Druckereinstellung</strong></button></a>
</div>@endif

        @if ($user->a4drucker=='9999'&& $user->labeldrucker!='9999')
            <div class="alert alert-warning" role="alert">
  Es wurde noch kein A4drucker in den Druckereinstellungen ausgewählt bitte wählen Sie einen Dokumentendrucker aus. <a href="admin/druckereinstellungen" class="alert-link"><button class="btn btn-info"><strong>Druckereinstellung</strong></button></a>
</div>@endif


        <div class="input-box quality">

            <label class="page-title"  for="scan">Kommissionieren /<br> <span class="bold-text">Qualitätskontrolle</span>
            </label>
            <input id="scan" type="text" class="d-block"  autofocus oninput="handleChangeInvoiceNumberNew(event)">
            <p class="grey">Scanne den Auftrag</p>
        </div>
          <a href="/">
            <button class="btn btn-warning text-dark mr-3"> Zurück</button>
        </a>
    </div>
@endsection
