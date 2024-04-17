@extends("layouts.app")

@section("title", "Repairlabel")
@section("content")
    <div class="main-container pt-2 pd-2" id="invoice">
        <div class="input-box quality">

            <label class="page-title"  for="scan"><span class="bold-text">Repairlabel erstellen</span>
            </label>
            <input id="scan" type="text" class="d-block"  autofocus oninput="createRepairLabel(event)">
            <p class="grey">BillbeeId eingeben </p>
        </div>

 <a href ="/" >
    <button type="button" class="btn btn-outline-primary float-right">Zurück</button></a>
</div>
@endsection

