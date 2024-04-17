@extends("layouts.app")

@section("title", "Print Label again")

@section("content")
@php
   $invs = json_decode(json_encode($order['myorder']));
        foreach($invs as $invoicedata){
            $invoice = $invoicedata[0]->invoice_number;
        }
@endphp

    <div class="main-container pt-2 pb-2" id="print_again_order_content">
      <div id="invoice_number">{{$invoice}}</div>
        <div class="flex-between border-btm pt-2" data-invoice="{{$invoice}}">
            <div class="barcode-box">
              <?= '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($invoice, "C39",1,50) . '" alt="barcode"   />' ?>
            </div>
            <table class="info-table ml-2">
                <thead>
                    <td>Produkt</td>
                    <td>EAN</td>
                    <td>Anzahl</td>
                </thead>

                 @foreach($order['order']->data->orderItems as $orderItem)
                 @if(array_key_exists("ean",$orderItem->product))
                      @if($orderItem->product->ean)

                        <tr data-EAN="{{$orderItem->product->ean}}">
                            <td>{{$orderItem->product->title}}</td>
                            <td>{{$orderItem->product->ean}}</td>
                            <td>{{$orderItem->quantity}}</td>
                        </tr>
                      @endif

					  @else
						    @if($orderItem->product->EAN)
						  <tr data-EAN="{{$orderItem->product->EAN}}">
                            <td>{{$orderItem->product->Title}}</td>
                            <td>{{$orderItem->product->EAN}}</td>
                            <td>{{$orderItem->quantity}}</td>
                        </tr>
						  @endif

					  @endif
                @endforeach
            </table>
        </div>
    </div>
    <div class="main-container pt-2 pb-2 buttons_print_again">
        <a href="/" class="shipment-order-back">
            <button class="main-btn mt-2 back">&lt; Zurück</button>
        </a>

        <button class="main-btn mt-2 no-print" onclick="printOrderAgain()">
            Print
        </button>
    </div>

@endsection
