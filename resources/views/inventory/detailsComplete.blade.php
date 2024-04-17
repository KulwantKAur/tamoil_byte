@extends("layouts.app")

@section("title", "Gesamt Bestand")

@section("content")

<div class="main-container pt-2 pb-2">
    <h5 class="page-title">
        <span class="bold-text"></span>
    </h5>

    <div class="print_main">
        <table id="example" class='display dataTable' style="width:100%">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>EAN</th>
                    <th>HH Lokation</th>
                    <th>HH - A</th>
					<th>HH - B</th>
                    <th>CGN - A</th>
					<th>CGN - B</th>
                    <th>B2B Pltfm</th>
					<th>Safety</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="buttons_print">
        <input type="hidden" id="recordsTotal" />
        <button class="main-btn mt-2 no-print" id="exportexcel">CSV Download</button>
        <a href="/">
        <button class="btn btn-outline-primary float-right mt-3"> Zurück</button>
        </a>
    </div>
</div>

@endsection
<!-- Govinder 03-04-20 start -->
@section('scripts')
@parent
<!-- Govinder 03-04-20 start -->
<!-- Datatable CSS -->
<link href='//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {
	var format = function date2str(x, y) {
    var z = {
        M: x.getMonth() + 1,
        d: x.getDate(),
        h: x.getHours(),
        m: x.getMinutes(),
        s: x.getSeconds()
    };
    y = y.replace(/(M+|d+|h+|m+|s+)/g, function(v) {
        return ((v.length > 1 ? "0" : "") + eval('z.' + v.slice(-1))).slice(-2)
    });

    return y.replace(/(y+)/g, function(v) {
        return x.getFullYear().toString().slice(-v.length)
    });
}
    var table = $('#example').DataTable( {
        pageLength:10,
        ajax: "{{ route('inventorysComplete') }}",
        columns: [
            { "data": "title" },
            { "data": "ean" },
            { "data": "stock_code_A-Ware_Hamburg" },
            { "data": "stock_current_A-Ware_Hamburg" },
			{ "data": "stock_current_B-Ware_Hamburg" },
			{ "data": "stock_current_A-Ware_Koeln" },
			{ "data": "stock_current_B-Ware_Koeln" },
            { "data": "stock_current_B2B_Plattform" },
            { "data": "stock_current_Safetystock" },
        ],
        buttons: [
            {
                extend: 'csv',
                title: "INventory_Export_"+format(new Date(), 'yyyy-MM-dd')+".csv"
            }
        ]
    } );

    $("#exportexcel").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

} );

</script>

@endsection
<!-- Govinder 03-04-20 end -->
