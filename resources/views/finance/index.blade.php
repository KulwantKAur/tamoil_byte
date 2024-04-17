@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")

    <h2 class="finance_title">Billbee Finance Exports</h2>
    <div class="finance_content">
        <form action="{{route('exportCsv')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="RE" name="export_type"/>
            <input type="submit" value="Rechnungs Export"/>
        </form>
        <form action="{{route('exportCsv')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="GS" name="export_type"/>
            <input type="submit" value="Gutschrift Export"/>
        </form>
        <form action="{{route('exportCsv')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="DE" name="export_type"/>
            <input type="submit" value="Debitor Export"/>
        </form>
        <form action="{{route('exportCsv')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="LI" name="export_type"/>
            <input type="submit" value="Limit Export"/>
        </form>
        <a href="{{route('setPaymentLimit')}}">Debitor Zahlungsziel & Limit setzen"</a>
        <a href="{{route('manualExport')}}">Manueller Export"</a>
    </div>
    <a href="/">
        <button class="btn btn-warning mt-2 back">< Zurück</button>
    </a>

@endsection
