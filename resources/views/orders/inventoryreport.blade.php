@extends("layouts.app")

@section("title", "Auftragsliste")
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
        <span class="bold-text">O N O M A O - Auftragsliste</span> {{Session::get('count')}} von {{Session::get('total_count')}}</br>
        @if($billbeeId == 'b2c')
        <small>eCom Bestellungen</small>
        @endif
        @if($billbeeId == 'reklamation')
        <small>Reklamationen</small>
        @endif
        @if($billbeeId == 'marketing')
        <small>Marketing oder Warensendungen </small>
        @endif
        @if($billbeeId == 'b2b')
        <small>B2B Bestellungen</small>
        @endif
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
	@foreach($data as $result)
    @foreach($result as $order)
    <div class="print_main no-print">
        <div style="font-weight: bold; padding-top: 7px; ">Bestellung: {{$order->orderNumber}} @if($order->sellerComment) </div>
        <div>Hinweise zur Bestellung: {{$order->sellerComment}}@endif</div>
		@if($order->shippingProviderProductId == '253227' || $order->shippingProviderProductId == '287342')
			<small><div> ACHTUNG - EXPORT Dokumente nicht vergessen</div></small>
		@endif
        <div>
            <table style="width:100%">
                <td style="width:30%">
                    <?=
                        '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->id, "C39", 1, 50) . '" alt="barcode"   />'
                    ?>
                </td>
                <!-- Append company name below barcode   
							
                    CM: ID is still the billbeeID and not the "value" the below does not work-->
                    <td style="width:65%">
                    @if($billbeeId == 'b2b')
                    <div style="font-size: 16px;padding-top: 7px;">{{ $order->invoiceAddress->company }}</div>
                    @endif
                    
                    <div style="font-size: 16px;padding-top: 7px;">Senden an: {{ $order->shippingAddress->firstName }} {{ $order->shippingAddress->lastName }} </div>
                    
                    <div><small>Rechnungsnummer: {{$order->invoiceNumberPrefix . $order->invoiceNumber}} </br> BillBeeID: {{$order->id}}</small></div>
                                
                    @if($order->shippingProviderProductId == '253227' || $order->shippingProviderProductId == '287342')
                    <div>!ACHTUNG EXPORT!</div>
                    @endif
                    <?php $date = json_decode(json_encode($order->createdAt),true); ?>

                    <div>Date : {{date("d-m-Y", strtotime($date['date']))}}</div>

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
                    @foreach($order->orderItems as $orderItem)
                    @if(!in_array($orderItem['product']['ean'], $sets))
						@if(array_key_exists("ean",$orderItem['product']))
                          
                        
                                    @if(isset($orderItem['product']['ean']))
                                    <tr>
                                        <td>{{$orderItem['product']['title']}}</br>{{$orderItem['product']['sku']}}</td>
                                        <td>
                                            <?= '<img style="width:300px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderItem['product']['ean'], "C39", 1, 50) . '" alt="barcode"   />' ?>
                                            <p><small>{{$orderItem['product']['ean']}}</small></p>
                                        </td>
                                        <td>{{$orderItem['product']['StockCode']}}</td>
                                        <td>{{$orderItem['quantity']}}</td>
                                    </tr>
                                    @endif
                             
                            @endif
                            @if(isset($orderItem['product']['EAN']))
                                <tr>
                                    <td>{{$orderItem['product']['title']}}</br>{{$orderItem['product']['sku']}}</td>
                                    <td>
                                        <?= '<img style="width:300px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderItem['product']['EAN'], "C39", 1, 50) . '" alt="barcode"   />' ?>
                                        <p><small>{{$orderItem['product']['ean']}}</small></p>
                                    </td>
                                    <td>{{$orderItem['product']['StockCode']}}</td>
                                    <td>{{$orderItem['quantity']}}</td>
                                </tr>
                                @endif
                        

                        @endif
                    @endforeach
                </tbody>
            </table>
            </br>

        </div>
    </div>
    <div  style="page-break-before: always"></div>
    @endforeach
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