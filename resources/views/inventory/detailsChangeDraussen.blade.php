@extends('layouts.app')
@section("title", "Bestand Draussen.de")
@section('content')
<div class="main-container pt-2 pb-2">
    <h5 class="page-title">
        <span class="bold-text"></span>
    </h5>
    <div class="print_main">
    <div class="card-block">
    <div class="table-responsive">
        <table id="example" class='display dataTable' style="width:100%">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produkt</th>
                                    <th scope="col">Ean</th>
                                    <th scope="col">Sku</th>
                                    <th scope="col">Anzahl</th>
                                    <th scope="col">Lokation</th>
                                    @can('InventoryChange')
                                    <th scope="col">Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product-> products_name}}</td>
                                    <td>{{$product-> products_ean}}</td>
                                    <td>{{$product-> products_sku}}</td>
                                    <td>{{$product-> products_unitamount}}</td>
                                    <td>{{$product-> products_stocklocation}}</td>
                                    @can('InventoryChange')
                                    <form>
                                    <td>
                                        <div class="btn-group">
                                          
                                            <a href ="{{route('inventory.edit', $product->id) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Edit Lokation</button>
                                            </a>
                                        </div>
                                    </td> 
                                    </form>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>

</table>
        <div class="buttons_print">
        <input type="hidden" id="recordsTotal" />
        <button class="btn btn-warning mt-2 no-print" id="exportexcel">CSV Download</button>
        <a href ="/" >
            <button type="button" class="btn btn-warning mt-2 back float-right">Zurück</button></a>
        </div>
    </div>
</div>
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
        // pageLength:10,
        buttons: [
            {
                extend: 'csv',
                title: "INventory_Export_"+format(new Date(), 'yyyy-MM-dd')+".csv"
            }
        ]
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
    } );

    $("#exportexcel").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });
});



</script>
@endsection

<!-- Govinder 03-04-20 end -->
