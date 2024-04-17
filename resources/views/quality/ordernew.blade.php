@extends("layouts.app")

@section("title", "Kommissionieren")
<style>
.container {
    max-width: 100% !important;
}
</style>
@section("content")

    <div class="main-container pt-2 pb-2" id="invoice">



        @if($order && $order->data)

            <div>{{$order->data->id}} Zu kommissionieren:</div>

            <div class="d-flex justify-content-start" data-invoice="{{$order->data->id}}">
                <div class="barcode-box">

					<div>
                        <small>

						Rechnungsnummer: {{$order->data->invoiceNumberPrefix . $order->data->invoiceNumber}} </br>

						@if($order->data->sellerComment) Hinweise: {{$order->data->sellerComment}}@endif
                        @if($hasLabel==true) Label schon vorproduziert. nur noch ausdrucken. @endif
                        </small>
                     </div>
					@if($order->data->shippingProviderProductId == '161813')
                    <div> EXPORT</div>
                    @endif
                    @if($order->data->shippingProviderId == '20321')
                    <div>!ACHTUNG AMAZON PRIME - DPD!</div>
                    @endif
					 <div style="font-size: 14px;">
                        Name: {{$order->data->customer->name}}
                     </div>
                    <div class="">
                        <input type="text" class="d-block mt-2" autofocus oninput="handleChangeProductBarcode(event)" id="barcode">
                    </div>
                    <p class="grey">Scanne die Produkte</p><br/>

                    <form  method="POST" action="{{ route('newshipping',$order->data->id) }}">
						<div class="form-check">

                        {{-- for sollte die id des inputs beinhalten dann kann man auch auf das label drücken um die Checkbox zu "aktivieren" --}}
							 <!-- <input type="hidden" class="form-check-input" id="DeliveryNote"  name="DeliveryNote"  > -->

                            <input type="checkbox" class="form-check-input" id="DeliveryNote"  name="DeliveryNote"  >
							<label class="form-check-label" for="DeliveryNote" > Lieferschein drucken</label>

                        </div>

					<br/>

                </div>


                <div class="w-100 p-3">
                <table class="info-table ml-2">
                    <thead>
                        <td>Produkt</td>
                        <td>EAN</td>
                        <td>Extra</td>
                        <td>Anzahl</td>
                        <td>Verpackt</td>
                        <td class="scanned-message"></td>

                    </thead>

                    @foreach($order->data->orderItems as $key => $orderItem)

							@if(array_key_exists("ean",$orderItem))
							@if(isset($orderItem['ean']))
                            <tr data-EAN="{{$orderItem['ean']}}">
                                <td>{{$orderItem["title"]}}</td>
								<td>{{$orderItem["ean"]}}</td>
                                <td>

                                @if($orderItem["giftcardPrint"])
                                  
                                    <!-- <a href="/giftcardprint/{{$order->data->id}}"><img src="http://lager.kerbholz.com/images/drucker.gif"></a> -->
                                   <a href="#" onclick="printGiftCard({{$order->data->id}}, {{$ean}})"><img src="http://lager.kerbholz.com/images/drucker.gif"></a>
                                @endif
                                @if($orderItem["wrapping"])
                                    <img src="http://lager.kerbholz.com/images/wrapping.gif">
                                @endif                                
                                </td>
                                <td>
                                
                                    {{$orderItem["quantity"]}}

                                </td>
                                <td class="scanned-quantity">{{$orderItem["scanned_quantity"]}}</td>
                                <td class="scanned-message">
                                    <span class="message d-none"></span>
                                </td>
                            </tr>
                            @endif
							@else
							@if(isset($orderItem['EAN']))
							<tr data-EAN="{{$orderItem['EAN']}}">
                                <td>{{$orderItem["title"]}}</td>
								<td>{{$orderItem["EAN"]}}</td>
                                <td>

                                @if($orderItem["giftcardPrint"])
                                   
                                    <!-- <a href="/giftcardprint/{{$order->data->id}}"><img src="http://lager.kerbholz.com/images/drucker.gif"></a> -->
                                   <a href="#" onclick="printGiftCard({{$order->data->id}}, {{$orderItem["EAN"]}})"><img src="http://lager.kerbholz.com/images/drucker.gif"></a>
                                  
                                @endif
                                @if($orderItem["wrapping"])
                                    <img src="images/wrapping.gif">
                                @endif                                
                                </td>
                                <td>

                                    {{$orderItem["quantity"]}}
                               
                                </td>
                                <td class="scanned-quantity">{{$orderItem["scanned_quantity"]}}</td>
                                <td class="scanned-message">
                                    <span class="message d-none"></span>
                                </td>
                            </tr>
							@endif
							@endif

                    @endforeach
                </table>
				</div>
            </div>
			<br/>
 <div class="flex-between mt-5 ml-5">
     <!-- @csrf -->
     <!-- {{ method_field('GET') }} -->
     <button type="submit" class="main-btn btn disabled" id="submit">Erstelle Shipping label</button>
    </form>
    <a href="/qualitynew" class="quality-back">
        <button class="main-btn btn back ml-5  float-right"> Zurück</button>
    </a>
</div>
</div>
@endif
    @push('scripts')
        <script>
            setOrderItems(JSON.parse('<?= json_encode(($order && $order->data) ? $order->data->orderItems : []); ?>'), '<?= ($order && $order->data) ? ($order->data->id) : ""?>')
        </script>
    @endpush
@endsection
