@extends("layouts.app")

@section("title", "Qualitätskontrolle")

@section("content")
    <div class="main-container pt-2 pb-2">

        <h5 class="page-title">Erstelle <span class="bold-text">Shipment Label</span></h5>

        <div class="d-flex">
            <div>
                <div class="input-box pb-2">
                    <label class="page-title" for="from">From:</label>
                    <input id="from" type="date" class="d-block" value="{{date('Y-m-d', strtotime('-7 days'))}}">
                </div>
                <div class="input-box pb-2">
                    <label class="page-title" for="to">To:</label>
                    <input id="to" type="date" class="d-block" value="{{date("Y-m-d")}}">
                </div>
            </div>

            <div class="d-flex shipment-buttons">
                <div>
                    <button class="main-btn ml-2 mt-2 btn" onclick="getShipment()">
                        Überprüfe Bestellungen
                    </button>
                </div>
                <div>
                    <a href="/">
                        <button class="btn btn-warning text-dark">< Zurück</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
