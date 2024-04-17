@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")
    <div class="main-container pt-2 pb-2">
        <h5 class="page-title">
            <span class="bold-text">Erstelle Shipment Label</span>
        </h5>
        @if($data && count($data))
            @foreach($data as $order)
            <div>{{$order->invoiceNumberPrefix . $order->invoiceNumber}}</div>

            <div class="flex-between border-btm pt-2" data-invoice="{{$order->invoiceNumberPrefix . $order->invoiceNumber}}">
                <div class="barcode-box">
                  <?=
                    '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->invoiceNumberPrefix . $order->invoiceNumber, "C39",1,50) . '" alt="barcode"   />'
                  ?>
                </div>
                <table class="info-table ml-2">
                    <thead>
                        <td style="width: 30%">Produkt</td>
                        <td style="width: 10%">Value</td>
                        <td style="width: 30%">EAN</td>
                        <td style="width: 15%">Anzahl</td>
                        <td style="width: 15%">Verpackt</td>
                    </thead>
                    @foreach($order->orderItems as $orderItem)
                        @if($orderItem["EAN"])
                            <tr data-EAN="{{$orderItem["EAN"]}}">
                                <td>{{$orderItem["title"]}}</td>
                                <td>{{ !is_null($orderItem["EAN_value"])? $orderItem["EAN_value"] : '' }}</td>
                                <td>{{$orderItem["EAN"]}}</td>
                                <td>{{$orderItem["quantity"]}}</td>
                                <td class="scanned-quantity">{{$orderItem["scanned_quantity"]}}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            @endforeach
            <div class="d-flex no-print">
                <div>
                    <a href="/" class="shipment-order-back">
                        <button class="main-btn mt-2 back">< Zurück</button>
                    </a>
                </div>
                <div>
                    <button class="main-btn mt-2 no-print btn" id="createShipping" onclick="createShippingByDate('{{$fromDate}}', '{{$toDate}}')">
                        Drucke alle Shipment Label
                    </button>
                </div>
            </div>
        @endif
    </div>

@endsection
@push('scripts')
    <script>
        const orderData = JSON.parse('<?= json_encode($data ? $data : []) ?>');

       if(typeof orderData == 'object'){
           for(let key in orderData){
               setOrderItems(orderData[key].orderItems, orderData[key].invoiceNumberPrefix + orderData[key].invoiceNumber);
           }
       }else if (Array.isArray(orderData)){
           orderData.forEach((item, index) => {
               setOrderItems(item.orderItems, item.invoiceNumberPrefix + item.invoiceNumber);
           })
       }

        setScannedOrderItemsForDatePeriod(JSON.parse('<?= json_encode($invoiceNumbers ? $invoiceNumbers : []); ?>'));
    </script>
@endpush