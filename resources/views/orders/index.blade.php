@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")
    <div class="main-container pt-2 pb-2">
{{-- refreshOrderPage(event) --}}
        <h5 class="page-title">
            <span class="bold-text">KERBHOLZ Auftragsliste</span> {{Session::get('count')}} von {{Session::get('total_count')}}</br>
        </h5>
        <div class="input-group mb-3"> <!-- mr => setzt einzelne felder weiter nach rechts-->
        <p class="date no-print mr-3">Von: <input type="text" onfocus="(this.type='date')" id="date_from" placeholder="{{$date['minOrderDate']}}"></p>

        <p class="date no-print mr-3">Bis: <input type="text" onfocus="(this.type='date')" id="date_to" placeholder="{{$date['maxOrderDate']}}"></p>
        </div>
        <div class="flex-between mb-2">

    </div>
    <div class="flex-between mb-1">
          <button class="btn btn-warning mt-1 no-print text-dark" onclick="printOrdersAll()">Alle  Drucken</button>
        <button class="btn btn-warning mt-1 no-print text-dark" onclick="printOrders()">Auswahl Drucken</button>
        <button class="btn btn-warning mt-1 no-print text-dark" id="toggleAll" name="toggleAll" >Alle Markieren</button>
         <a href="/" class="no-print back">
            <button class="btn btn-warning text-dark">Zurück</button>
        </a>
    </div>

    @if($data && count($data))
	@foreach($data as $result)
    @foreach($result as $order)
    <div class="print_main no-print">

        <div style="font-weight: bold; padding-top: 25px; ">Bestellung: {{$order->orderNumber}} @if($order->sellerComment) </div>
        <div>Hinweise zur Bestellung: {{$order->sellerComment}}@endif</div>

        <div>
            <table style="width:100%">
                <td style="width:40%">
                    <?=
                        '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->id, "C39", 1, 50) . '" alt="barcode"   />'
                    ?>
                </td>
                <!-- Append company name below barcode

                    CM: ID is still the billbeeID and not the "value" the below does not work-->
                    <td style="width:60%">
                    @if($billbeeId == 'b2b')
                    <div style="font-size: 16px;padding-top: 7px;">{{ $order->invoiceAddress->company }}</div>
                    @endif



                    <div><small>Rechnungsnummer: {{$order->invoiceNumberPrefix . $order->invoiceNumber}} </br> BillBeeID: {{$order->id}}</small></div>

                    @if($order->shippingProviderProductId == '209113')
                    <div>EXPORT</div>
                    @endif
                    <?php $date = json_decode(json_encode($order->createdAt),true); ?>

                    <div><small>Date : {{date("d-m-Y", strtotime($date['date']))}}</small></div>

                </td>
                <td style="width:5%">
                    <input class="checkbox no-print" type="checkbox" name="printbox">
                </td>
            </table>
           
        </div>
		<div class="flex-between border-btm pt-2">

            <table class="info-table ml-2" style="width:100%">
                            <thead>
                            <td style="width: 30%">Produkt</td>
                            <td style="width: 10%">Extra</td>
                            <td style="width: 30%">EAN</td>
                            <td style="width: 15%">Lokation</td>
                            <td style="width: 15%">Anzahl</td>
                            </thead>

                <tbody>
                   @foreach($order->orderItems as $orderItem)
                                 @if(array_key_exists("ean",$orderItem['product']))
                                    @if(!in_array($orderItem['product']['ean'], $sets))
                                        @if ($orderItem['product']['ean'] != null)
                                            <tr>
                                                <td>{{$orderItem['product']['title']}}</br><small>{{$orderItem['product']['sku']}}</small></td>
                                                <td>
                                                    <!-- OLD Charm Code
                                                    @if(isset($orderItem['attributes']))
                                                        @foreach($orderItem['attributes'] as $attribute)
                                                            @if(!is_null($attribute['value']) && $attribute['value'])
                                                                {{ $attribute['value'] }}
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endif -->

                                                    @if(isset($orderItem['attributes']))
                                                        @foreach($orderItem['attributes'] as $attribute)
                                                            @if(!is_null($attribute['value']) && $attribute['name'] == 'PERSÖNLICHE NACHRICHT :')
                                                                <img src="http://lager.kerbholz.com/images/drucker.gif">
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if(isset($orderItem['attributes']))
                                                        @foreach($orderItem['attributes'] as $attribute)
                                                            @if(!is_null($attribute['value']) && $attribute['value'] == 'Als Geschenk verpacken (+4€)' )
                                                                <img src="http://lager.kerbholz.com/images/wrapping.gif">
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                
                                                </td>

                                                <td><small>{{$orderItem['product']['ean']}}</small></td>
                                                <td>{{isset($orderItem['product']['StockCode'])? $orderItem['product']['StockCode'] :''}}</td>
                                                <td>{{$orderItem['quantity']}}</td>
                                            </tr>
                                        @endif
                                    @endif
								@else

                                            <tr>
                                        <td>{{$orderItem['product']['title']}}</br><small>{{$orderItem['product']['sku']}}</small></td>
                                        <td>
                                            @if(isset($orderItem['attributes']))
                                                @foreach($orderItem['attributes'] as $attribute)
                                                    @if(!is_null($attribute['value']) && $attribute['value'])
                                                        {{ $attribute['value'] }}
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                                {{-- zeigt die Schmucksets nur noch in ihren einzelnen Bestellungen an --}}
                                        @if (!in_array($orderItem['product']['EAN'], $sets)|| !isset($orderItem['product']['EAN']))
                                                <td><small>{{$orderItem['product']['EAN']}}</small></td>
                                                <td>{{isset($orderItem['product']['StockCode'])? $orderItem['product']['StockCode'] :''}}</td>
                                                <td>{{$orderItem['quantity']}}</td>
                                            </tr>


                                        @endif

								@endif

                            @endforeach
                </tbody>
            </table>



    </div>
	</div>

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

	$('#toggleAll').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = false;
			$(this).parents('.print_main').addClass('no-print');
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = true;
			$(this).parents('.print_main').removeClass('no-print');

        });
    }
	});



</script>
@endpush
