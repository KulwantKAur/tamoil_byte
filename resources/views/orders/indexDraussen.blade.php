@extends("layouts.app")

@section("title", "Draussen.de Auftragsliste")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .container {
        max-width: 100% !important;
    }

    .date {
        margin-top: 1rem;
        margin-bottom: 0px;
    }

    .checkbox {
        float: right;
        width: 30px;
        height: 30px;
        margin-bottom: 2px;
    }
</style>
@section("content")
<div class="main-container pt-2 pb-2">
    <h5 class="page-title">
        <span class="bold-text">DRAUSSEN.DE - Auftragsliste</span> {{Session::get('count')}} von {{Session::get('total_count')}}</br>
       
    </h5>

    <div class="flex-between mb-2">

        <button class="main-btn mt-1 no-print" onclick="printOrdersAll()">Alle  Drucken</button>
        <button class="main-btn mt-1 no-print" onclick="printOrders()">Auswahl Drucken</button>
        <p class="date no-print">Von: <input type="text" onfocus="(this.type='date')" id="date_from" placeholder="{{$date['minOrderDate']}}"></p>
        <p class="date no-print">Bis: <input type="text" onfocus="(this.type='date')" id="date_to" placeholder="{{$date['maxOrderDate']}}"></p>
        <a href="/" class="no-print back">
            <button class="main-btn mt-1 back">ZUR&Uuml;CK</button>
        </a>
    </div>

    @if($data && count($data))
	@foreach($data as $order)
    //break!
    <div class="print_main no-print">
        <div style="font-weight: bold; padding-top: 7px; ">Bestellung: {{$order->shoporder_order_nr}} 
		
        <div>
            <table style="width:100%">
                <td style="width:30%">
                    <?=
                        '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->shoporder_id, "C39", 1, 50) . '" alt="barcode"   />'
                    ?>
                </td>
                
							
                   
                    <td style="width:65%">
                   
                    
                    <div style="font-size: 16px;padding-top: 7px;">Senden an: {{ $order->customer->customer_email }}</div>
                    
                    
                                
                   
                    

                </td>
                <td style="width:5%">
                    <input class="checkbox no-print" type="checkbox">
                </td>
            </table>
     
        </div>
        <div>
            <table class="table table-bordered ml-2">
                <thead>
                    <th>SKU</th>
                    <th>EAN BarCode</th>
                    <th>Lokation</th>
                    <th>Anzahl</th>
                </thead>

                <tbody>
                    @foreach($order->orderarticles as $orderItem)
                    
                        <tr>
                            <td>{{$orderItem->orderarticles_name}}</br>{{$orderItem->orderarticles_sku}}</td>
                            <td>
                                <?= '<img style="width:300px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderItem->orderarticles_sku, "C39", 1, 50) . '" alt="barcode"   />' ?>
                                <p><small>ean kommt nocht</small></p>
                            </td>
                            <td>Stock Location kommt noch </td>
                            <td>orderarticles_amount</td>
                        </tr>
                                   
                    @endforeach
                </tbody>
            </table>
            </br>

        </div>
    </div>
    <div  style="page-break-before: always"></div>
    @endforeach
	
    @endif
</div>

@endsection
@push('scripts')
<script>

    $("#date_to").on('change', function() {
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        if (date_from == '' && date_to == '') {
            alert("Invalid date.");
        }

        showLoader();
        $.ajax({
            type: 'GET',
            url: '/orders',
            data: {
                'date_from': date_from,
                'date_to': date_to
            },
            success: function(data) {
                $('body').html(data);
                hideLoader();
            }
        });
    });
    $('.checkbox').click(function() {
        var ischecked= $(this).is(':checked');
        if(ischecked){
            $(this).parents('.print_main').removeClass('no-print');
        }else{
            $(this).parents('.print_main').addClass('no-print');
        }
    });

    
</script>
@endpush