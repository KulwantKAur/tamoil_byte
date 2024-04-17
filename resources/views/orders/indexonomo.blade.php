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
    @foreach($data as $order)
    <div class="print_main no-print">
        <div style="font-weight: bold; padding-top: 7px; ">Bestellung: {{$order->orderNumber}} @if($order->sellerComment) </div>
        <div>Hinweise zur Bestellung: {{$order->sellerComment}}@endif</div>

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
                                
                    @if($order->shippingProviderProductId == '209113')
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
                    @if(array_key_exists("ean",$orderItem->product))
                        @if($orderItem->product->ean != '4200000000001'
                                    && $orderItem->product->ean != '4200000000002'
                                    && $orderItem->product->ean != '4200000000003'
									&& $orderItem->product->ean != '1234567890001'
									&& $orderItem->product->ean != '1234567890002'
									&& $orderItem->product->ean != '1234567890003'
									&& $orderItem->product->ean != '1234567890004'
									&& $orderItem->product->ean != '1234567890005'
									&& $orderItem->product->ean != '1234567890006'
									&& $orderItem->product->ean != '1234567890007'
									&& $orderItem->product->ean != '1234567890008'
									&& $orderItem->product->ean != '1234567890009'
									&& $orderItem->product->ean != '1234567890010'
									&& $orderItem->product->ean != '1234567890201'
									&& $orderItem->product->ean != '1234567890011'
									&& $orderItem->product->ean != '1234567890012'
									&& $orderItem->product->ean != '1234567890013'
									&& $orderItem->product->ean != '1234567890014'
									&& $orderItem->product->ean != '1234567890015'
									&& $orderItem->product->ean != '1234567890016'
									&& $orderItem->product->ean != '1234567890017'
									&& $orderItem->product->ean != '1234567890018'
									&& $orderItem->product->ean != '1234567890019'
									&& $orderItem->product->ean != '1234567890020'
									&& $orderItem->product->ean != '1234567890021'
									&& $orderItem->product->ean != '1234567890022'
									&& $orderItem->product->ean != '1234567890023'
									&& $orderItem->product->ean != '1234567890024'
									&& $orderItem->product->ean != '1234567890025'
									&& $orderItem->product->ean != '1234567890026'
									&& $orderItem->product->ean != '1234567890027'
									&& $orderItem->product->ean != '1234567890028'
									&& $orderItem->product->ean != '1234567890029'
									&& $orderItem->product->ean != '123456789202'
									&& $orderItem->product->ean != '1234567890030'
									&& $orderItem->product->ean != '1234567890031'
									&& $orderItem->product->ean != '1234567890032'
									&& $orderItem->product->ean != '1234567890033'
									&& $orderItem->product->ean != '1234567890034'
									&& $orderItem->product->ean != '1234567890035'
									&& $orderItem->product->ean != '1234567890036'
									&& $orderItem->product->ean != '1234567890037'
									&& $orderItem->product->ean != '1234567890038'
									&& $orderItem->product->ean != '1234567890039'
									&& $orderItem->product->ean != '1234567890040'
									&& $orderItem->product->ean != '1234567890041'
									&& $orderItem->product->ean != '1234567890042'
									&& $orderItem->product->ean != '1234567890043'
									&& $orderItem->product->ean != '1234567890044'
									&& $orderItem->product->ean != '1234567890045'
									&& $orderItem->product->ean != '1234567890046'
									&& $orderItem->product->ean != '1234567890047'
									&& $orderItem->product->ean != '123456789203'
									&& $orderItem->product->ean != '1234567890048'
									&& $orderItem->product->ean != '1234567890049'
									&& $orderItem->product->ean != '1234567890050'
									&& $orderItem->product->ean != '1234567890051'
									&& $orderItem->product->ean != '1234567890052'
									&& $orderItem->product->ean != '1234567890053'
									&& $orderItem->product->ean != '1234567890054'
									&& $orderItem->product->ean != '1234567890055'
									&& $orderItem->product->ean != '1234567890056'
									&& $orderItem->product->ean != '1234567890057'
									&& $orderItem->product->ean != '1234567890058'
									&& $orderItem->product->ean != '1234567890059'
									&& $orderItem->product->ean != '1234567890060'
									&& $orderItem->product->ean != '1234567890061'
									&& $orderItem->product->ean != '1234567890062'
									&& $orderItem->product->ean != '1234567890063'
									&& $orderItem->product->ean != '1234567890064'
									&& $orderItem->product->ean != '1234567890065'
									&& $orderItem->product->ean != '1234567890066'
									&& $orderItem->product->ean != '1234567890067'
									&& $orderItem->product->ean != '1234567890068'
									&& $orderItem->product->ean != '1234567890069'
									&& $orderItem->product->ean != '1234567890070'
									&& $orderItem->product->ean != '1234567890071'
									&& $orderItem->product->ean != '1234567890072'
									&& $orderItem->product->ean != '1234567890073'
									&& $orderItem->product->ean != '1234567890074'
									&& $orderItem->product->ean != '1234567890075'
									&& $orderItem->product->ean != '1234567890076'
									&& $orderItem->product->ean != '1234567890077'
									&& $orderItem->product->ean != '1234567890078'
									&& $orderItem->product->ean != '1234567890079'
									&& $orderItem->product->ean != '1234567890080'
									&& $orderItem->product->ean != '1234567890081'
									&& $orderItem->product->ean != '1234567890082'
									&& $orderItem->product->ean != '1234567890083'
									&& $orderItem->product->ean != '1234567890084'
									&& $orderItem->product->ean != '123456789204'
									&& $orderItem->product->ean != '1234567890085'
									&& $orderItem->product->ean != '1234567890086'
									&& $orderItem->product->ean != '1234567890087'
									&& $orderItem->product->ean != '1234567890088'
									&& $orderItem->product->ean != '1234567890090'
									&& $orderItem->product->ean != '1234567890091'
									&& $orderItem->product->ean != '1234567890092'
									&& $orderItem->product->ean != '1234567890111'
									&& $orderItem->product->ean != '1234567890112'
									&& $orderItem->product->ean != '1234567890113'
									&& $orderItem->product->ean != '1234567890114'
									&& $orderItem->product->ean != '1234567890115'
									&& $orderItem->product->ean != '1234567890116'
									&& $orderItem->product->ean != '123456789206'
									&& $orderItem->product->ean != '1234567890117'
									&& $orderItem->product->ean != '1234567890118'
									&& $orderItem->product->ean != '1234567890119'
									&& $orderItem->product->ean != '1234567890093'
									&& $orderItem->product->ean != '1234567890094'
									&& $orderItem->product->ean != '1234567890095'
									&& $orderItem->product->ean != '1234567890096'
									&& $orderItem->product->ean != '1234567890097'
									&& $orderItem->product->ean != '1234567890098'
									&& $orderItem->product->ean != '1234567890099'
									&& $orderItem->product->ean != '1234567890100'
									&& $orderItem->product->ean != '1234567890101'
									&& $orderItem->product->ean != '1234567890102'
									&& $orderItem->product->ean != '1234567890103'
									&& $orderItem->product->ean != '123456789205'
									&& $orderItem->product->ean != '1234567890104'
									&& $orderItem->product->ean != '1234567890105'
									&& $orderItem->product->ean != '1234567890106'
									&& $orderItem->product->ean != '1234567890107'
									&& $orderItem->product->ean != '1234567890108x'
									&& $orderItem->product->ean != '1234567890109'
									&& $orderItem->product->ean != '1234567890110'
									&& $orderItem->product->ean != '123456789301' 
									&& $orderItem->product->ean != '123456789300' 
									&& $orderItem->product->ean != '0123456789302' 
									&& $orderItem->product->ean != '1234567890201' 
									&& $orderItem->product->ean != '123456789304' 
									&& $orderItem->product->ean != '123456789303' 
									&& $orderItem->product->ean != '123456789307' 
									&& $orderItem->product->ean != '123456789305' 
									&& $orderItem->product->ean != '123456789202' 
									&& $orderItem->product->ean != '123456789306' 
									&& $orderItem->product->ean != '123456789309' 
									&& $orderItem->product->ean != '123456789308' 
									&& $orderItem->product->ean != '123456789312' 
									&& $orderItem->product->ean != '123456789203' 
									&& $orderItem->product->ean != '123456789311' 
									&& $orderItem->product->ean != '123456789314' 
									&& $orderItem->product->ean != '123456789313' 
									&& $orderItem->product->ean != '123456789315' 
									&& $orderItem->product->ean != '123456789317' 
									&& $orderItem->product->ean != '123456789316' 
									&& $orderItem->product->ean != '123456789318' 
									&& $orderItem->product->ean != '123456789320' 
									&& $orderItem->product->ean != '123456789319' 
									&& $orderItem->product->ean != '123456789321' 
									&& $orderItem->product->ean != '123456789204' 
									&& $orderItem->product->ean != '123456789323' 
									&& $orderItem->product->ean != '123456789322' 
									&& $orderItem->product->ean != '123456789324' 
									&& $orderItem->product->ean != '123456789205' 
									&& $orderItem->product->ean != '123456789326' 
									&& $orderItem->product->ean != '123456789325' 
									&& $orderItem->product->ean != '123456789327' 
									&& $orderItem->product->ean != '123456789206'
                                    && $orderItem->product->ean != '')
                   
                        @if(isset($orderItem->product->ean))
                        <tr>
                            <td>{{$orderItem->product->title}}</br>{{$orderItem->product->sku}}</td>
                            <td>
                                <?= '<img style="width:300px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderItem->product->ean, "C39", 1, 50) . '" alt="barcode"   />' ?>
                                <p><small>{{$orderItem->product->ean}}</small></p>
                            </td>
                            <td>{{isset($orderItem->product->StockCode)? $orderItem->product->StockCode :''}}</td>
                            <td>{{$orderItem->quantity}}</td>
                        </tr>
                        @endif
                    @endif
                    @else
                        @if($orderItem->product->EAN != '4200000000001'
                                    && $orderItem->product->EAN != '4200000000002'
                                    && $orderItem->product->EAN != '4200000000003'
									&& $orderItem->product->EAN != '1234567890001'
									&& $orderItem->product->EAN != '1234567890002'
									&& $orderItem->product->EAN != '1234567890003'
									&& $orderItem->product->EAN != '1234567890004'
									&& $orderItem->product->EAN != '1234567890005'
									&& $orderItem->product->EAN != '1234567890006'
									&& $orderItem->product->EAN != '1234567890007'
									&& $orderItem->product->EAN != '1234567890008'
									&& $orderItem->product->EAN != '1234567890009'
									&& $orderItem->product->EAN != '1234567890010'
									&& $orderItem->product->EAN != '1234567890201'
									&& $orderItem->product->EAN != '1234567890011'
									&& $orderItem->product->EAN != '1234567890012'
									&& $orderItem->product->EAN != '1234567890013'
									&& $orderItem->product->EAN != '1234567890014'
									&& $orderItem->product->EAN != '1234567890015'
									&& $orderItem->product->EAN != '1234567890016'
									&& $orderItem->product->EAN != '1234567890017'
									&& $orderItem->product->EAN != '1234567890018'
									&& $orderItem->product->EAN != '1234567890019'
									&& $orderItem->product->EAN != '1234567890020'
									&& $orderItem->product->EAN != '1234567890021'
									&& $orderItem->product->EAN != '1234567890022'
									&& $orderItem->product->EAN != '1234567890023'
									&& $orderItem->product->EAN != '1234567890024'
									&& $orderItem->product->EAN != '1234567890025'
									&& $orderItem->product->EAN != '1234567890026'
									&& $orderItem->product->EAN != '1234567890027'
									&& $orderItem->product->EAN != '1234567890028'
									&& $orderItem->product->EAN != '1234567890029'
									&& $orderItem->product->EAN != '123456789202'
									&& $orderItem->product->EAN != '1234567890030'
									&& $orderItem->product->EAN != '1234567890031'
									&& $orderItem->product->EAN != '1234567890032'
									&& $orderItem->product->EAN != '1234567890033'
									&& $orderItem->product->EAN != '1234567890034'
									&& $orderItem->product->EAN != '1234567890035'
									&& $orderItem->product->EAN != '1234567890036'
									&& $orderItem->product->EAN != '1234567890037'
									&& $orderItem->product->EAN != '1234567890038'
									&& $orderItem->product->EAN != '1234567890039'
									&& $orderItem->product->EAN != '1234567890040'
									&& $orderItem->product->EAN != '1234567890041'
									&& $orderItem->product->EAN != '1234567890042'
									&& $orderItem->product->EAN != '1234567890043'
									&& $orderItem->product->EAN != '1234567890044'
									&& $orderItem->product->EAN != '1234567890045'
									&& $orderItem->product->EAN != '1234567890046'
									&& $orderItem->product->EAN != '1234567890047'
									&& $orderItem->product->EAN != '123456789203'
									&& $orderItem->product->EAN != '1234567890048'
									&& $orderItem->product->EAN != '1234567890049'
									&& $orderItem->product->EAN != '1234567890050'
									&& $orderItem->product->EAN != '1234567890051'
									&& $orderItem->product->EAN != '1234567890052'
									&& $orderItem->product->EAN != '1234567890053'
									&& $orderItem->product->EAN != '1234567890054'
									&& $orderItem->product->EAN != '1234567890055'
									&& $orderItem->product->EAN != '1234567890056'
									&& $orderItem->product->EAN != '1234567890057'
									&& $orderItem->product->EAN != '1234567890058'
									&& $orderItem->product->EAN != '1234567890059'
									&& $orderItem->product->EAN != '1234567890060'
									&& $orderItem->product->EAN != '1234567890061'
									&& $orderItem->product->EAN != '1234567890062'
									&& $orderItem->product->EAN != '1234567890063'
									&& $orderItem->product->EAN != '1234567890064'
									&& $orderItem->product->EAN != '1234567890065'
									&& $orderItem->product->EAN != '1234567890066'
									&& $orderItem->product->EAN != '1234567890067'
									&& $orderItem->product->EAN != '1234567890068'
									&& $orderItem->product->EAN != '1234567890069'
									&& $orderItem->product->EAN != '1234567890070'
									&& $orderItem->product->EAN != '1234567890071'
									&& $orderItem->product->EAN != '1234567890072'
									&& $orderItem->product->EAN != '1234567890073'
									&& $orderItem->product->EAN != '1234567890074'
									&& $orderItem->product->EAN != '1234567890075'
									&& $orderItem->product->EAN != '1234567890076'
									&& $orderItem->product->EAN != '1234567890077'
									&& $orderItem->product->EAN != '1234567890078'
									&& $orderItem->product->EAN != '1234567890079'
									&& $orderItem->product->EAN != '1234567890080'
									&& $orderItem->product->EAN != '1234567890081'
									&& $orderItem->product->EAN != '1234567890082'
									&& $orderItem->product->EAN != '1234567890083'
									&& $orderItem->product->EAN != '1234567890084'
									&& $orderItem->product->EAN != '123456789204'
									&& $orderItem->product->EAN != '1234567890085'
									&& $orderItem->product->EAN != '1234567890086'
									&& $orderItem->product->EAN != '1234567890087'
									&& $orderItem->product->EAN != '1234567890088'
									&& $orderItem->product->EAN != '1234567890090'
									&& $orderItem->product->EAN != '1234567890091'
									&& $orderItem->product->EAN != '1234567890092'
									&& $orderItem->product->EAN != '1234567890111'
									&& $orderItem->product->EAN != '1234567890112'
									&& $orderItem->product->EAN != '1234567890113'
									&& $orderItem->product->EAN != '1234567890114'
									&& $orderItem->product->EAN != '1234567890115'
									&& $orderItem->product->EAN != '1234567890116'
									&& $orderItem->product->EAN != '123456789206'
									&& $orderItem->product->EAN != '1234567890117'
									&& $orderItem->product->EAN != '1234567890118'
									&& $orderItem->product->EAN != '1234567890119'
									&& $orderItem->product->EAN != '1234567890093'
									&& $orderItem->product->EAN != '1234567890094'
									&& $orderItem->product->EAN != '1234567890095'
									&& $orderItem->product->EAN != '1234567890096'
									&& $orderItem->product->EAN != '1234567890097'
									&& $orderItem->product->EAN != '1234567890098'
									&& $orderItem->product->EAN != '1234567890099'
									&& $orderItem->product->EAN != '1234567890100'
									&& $orderItem->product->EAN != '1234567890101'
									&& $orderItem->product->EAN != '1234567890102'
									&& $orderItem->product->EAN != '1234567890103'
									&& $orderItem->product->EAN != '123456789205'
									&& $orderItem->product->EAN != '1234567890104'
									&& $orderItem->product->EAN != '1234567890105'
									&& $orderItem->product->EAN != '1234567890106'
									&& $orderItem->product->EAN != '1234567890107'
									&& $orderItem->product->EAN != '1234567890108x'
									&& $orderItem->product->EAN != '1234567890109'
									&& $orderItem->product->EAN != '1234567890110'
									&& $orderItem->product->EAN != '123456789301' 
									&& $orderItem->product->EAN != '123456789300' 
									&& $orderItem->product->EAN != '0123456789302' 
									&& $orderItem->product->EAN != '1234567890201' 
									&& $orderItem->product->EAN != '123456789304' 
									&& $orderItem->product->EAN != '123456789303' 
									&& $orderItem->product->EAN != '123456789307' 
									&& $orderItem->product->EAN != '123456789305' 
									&& $orderItem->product->EAN != '123456789202' 
									&& $orderItem->product->EAN != '123456789306' 
									&& $orderItem->product->EAN != '123456789309' 
									&& $orderItem->product->EAN != '123456789308' 
									&& $orderItem->product->EAN != '123456789312' 
									&& $orderItem->product->EAN != '123456789203' 
									&& $orderItem->product->EAN != '123456789311' 
									&& $orderItem->product->EAN != '123456789314' 
									&& $orderItem->product->EAN != '123456789313' 
									&& $orderItem->product->EAN != '123456789315' 
									&& $orderItem->product->EAN != '123456789317' 
									&& $orderItem->product->EAN != '123456789316' 
									&& $orderItem->product->EAN != '123456789318' 
									&& $orderItem->product->EAN != '123456789320' 
									&& $orderItem->product->EAN != '123456789319' 
									&& $orderItem->product->EAN != '123456789321' 
									&& $orderItem->product->EAN != '123456789204' 
									&& $orderItem->product->EAN != '123456789323' 
									&& $orderItem->product->EAN != '123456789322' 
									&& $orderItem->product->EAN != '123456789324' 
									&& $orderItem->product->EAN != '123456789205' 
									&& $orderItem->product->EAN != '123456789326' 
									&& $orderItem->product->EAN != '123456789325' 
									&& $orderItem->product->EAN != '123456789327' 
									&& $orderItem->product->EAN != '123456789206'
                                    && $orderItem->product->EAN != '')

                            @if(isset($orderItem->product->EAN))
                            <tr>
                                <td>{{$orderItem->product->title}}</br>{{$orderItem->product->Title}}</td>
                                <td>
                                    <?= '<img style="width:300px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderItem->product->EAN, "C39", 1, 50) . '" alt="barcode"   />' ?>
                                    <p><small>{{$orderItem->product->EAN}}</small></p>
                                </td>
                                <td>{{isset($orderItem->product->StockCode)? $orderItem->product->StockCode :''}}</td>
                                <td>{{$orderItem->quantity}}</td>
                            </tr>
                            @endif
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