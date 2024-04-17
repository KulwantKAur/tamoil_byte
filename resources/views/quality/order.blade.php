@extends("layouts.app")

@section("title", "Qualitätskontrolle")
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
                    <?= '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->data->id, "C39",1,50) . '" alt="barcode"   />' ?>
					<div>
                        <small>

						Rechnungsnummer: {{$order->data->invoiceNumberPrefix . $order->data->invoiceNumber}} </br>

						@if($order->data->sellerComment) Hinweise: {{$order->data->sellerComment}}@endif
                        </small>
                     </div>
					@if($order->data->shippingProviderProductId == '161813')
                    <div>!ACHTUNG EXPORT!</div>
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
					<form>
						<div class="form-check">
                        {{-- for sollte die id des inputs beinhalten dann kann man auch auf das label drücken um die Checkbox zu "aktivieren" --}}
							<input type="checkbox" class="form-check-input" id="DeliveryNote">
							<label class="form-check-label" for="DeliveryNote"> Lieferschein drucken</label>
						</div>
					</form>
					<br/>
                </div>


                <div class="mw-100">
                <table class="info-table ml-2">
                    <thead>
                        <td>Produkt</td>
                        <td>EAN</td>
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
                                <td>{{$orderItem["quantity"]}}</td>
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
                                <td>{{$orderItem["quantity"]}}</td>
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
			<br/><br/>
        <div class="flex-between mt-2">


            <!--div>
                <a href="/quality" class="quality-back" onclick="saveScannedProducts(event)">
                    <button class="main-btn mt-2 ml-2">Nächstes</button>
                </a>
            </div-->
                <button class="main-btn mt-5" id="createShipping" onclick="createShipping('{{$order->data->id}}')">
                    Erstelle Shipping label
                </button>
                <!--button class="main-btn ml-2 mt-2 btn" onclick="finishOrder('{{$order->data->id}}')">
                    FERTIG
                </button-->
                <a href="/quality" class="quality-back">
                    <button class="main-btn mt-5 back"> Zurück</button>
                </a>
        </div>
        @else
            <!--div class="input-box quality">
                <label class="page-title" for="scan">Kommissionieren /<br> <span class="bold-text">Qualitätskontrolle</span>
                </label>
                <input id="scan" type="text" class="d-block"  oninput="handleChangeInvoiceNumber(event)">
                <p class="grey">Scanne den Auftrag</p>
            </div>
            <a href="/">
                <button class="main-btn mt-2 back">< Zurück</button>
            </a-->
        @endif

    </div>

    @push('scripts')
        <script>
            setOrderItems(JSON.parse('<?= json_encode(($order && $order->data) ? $order->data->orderItems : []); ?>'), '<?= ($order && $order->data) ? ($order->data->id) : ""?>')
        </script>
    @endpush
@endsection
