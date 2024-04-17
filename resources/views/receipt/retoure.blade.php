@extends("layouts.app")

@section("title", "Return")

@section("content")

<table class="table" id="products" {{$i=1}}>

			</div>
        <thead>
            <tr>
            <th>Produkt</th>
            <th>Lokation</th>
            <th>EAN</th>
            <th>Wareneingang</th>
            <th>Reason Code</th>
            <th>Product Grade</th>
            </tr>
        </thead>
    <tbody>
        @foreach($orderarray as $key => $orderItem)
        @if(array_key_exists("ean",$orderItem))
        @if(isset($orderItem['ean']))
        <tr data-EAN="{{$orderItem['ean']}}">
            <td>{{$orderItem["title"]}}</td>
            <td>{{$orderItem["lokation"]}}</td>
            <td id="scan-ean">{{$orderItem["ean"]}}</td>
            <td><div class="form-outline">
                <input type="number" id="wareneingang{{$i}}" name="wareneingang" value="{{0}}" class="delta-quantity"/>
            </div></td>
             <td><select class="form-select" aria-label="Default select example" id="reason{{$i}}" name="reasonCode">
                    <option selected>Select Reason Code</option>
                    <option value="1">1 = Artikel weicht vom Foto ab</option>
                    <option value="2">2 = Artikel gefällt mir nicht</option>
                    <option value="3">3 = Artikel zu groß</option>
                    <option value="4">4 = Artikel zu klein</option>
                    <option value="5">5 = Artikel hat einen Materialfehler</option>
                    <option value="6">6 = falscher Artikel geliefert</option>
                    <option value="7">7 = Artikel ist zu spät eingetroffen</option>
                    <option value="8">8 = Preis/Leistung stimmt nicht</option>
                    <option value="9">9 = Paket beschädigt</option>
                </select></td>
            <td>
                <div class="form-check" >
                    <input class="form-check-input-sm" type="radio" name="exampleRadios {{$i}}" value="131" id="a-ware{{$i}}">
                     <label class="form-check-label" for="a-ware{{$i}}"> A-Ware</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input-sm" type="radio" name="exampleRadios {{$i}}" value="132" id="b-ware{{$i}}">
                     <label class="form-check-label" for="b-ware{{$i}}">B-Ware</label></div>
                <div class="form-check">
                    <input class="form-check-input-sm" type="radio" name="exampleRadios {{$i}}" value="Defekt" id="defekt{{$i}}">
                    <label class="form-check-label" for="defekt{{$i}}">Defekt</label>
                </div>
            </td>
        </tr>
        @endif
        @else
        @if(isset($orderItem['EAN']))
        <tr data-EAN="{{$orderItem['EAN']}}">
            <td>{{$orderItem["title"]}}</td>
            <td>{{$orderItem['lokation']}}</td>
            <td id="scan-ean{{$i}}" >{{$orderItem["EAN"]}}</td>
            <td><div class="form-outline">
                <input type="number"id="wareneingang{{$i}}" name="wareneingang" min="0"   max="{{$orderItem['quantity']}}" value="{{0}}"  class="delta-quantity"/>
            </div></td>
            <td><select class="form-select" aria-label="Default select example" id="reason{{$i}}" name="reasonCode">
                    <option selected>Select Reason Code</option>
                    <option value="1">1 = Artikel weicht vom Foto ab</option>
                    <option value="2">2 = Artikel gefällt mir nicht</option>
                    <option value="3">3 = Artikel zu groß</option>
                    <option value="4">4 = Artikel zu klein</option>
                    <option value="5">5 = Artikel hat einen Materialfehler</option>
                    <option value="6">6 = falscher Artikel geliefert</option>
                    <option value="7">7 = Artikel ist zu spät eingetroffen</option>
                    <option value="8">8 = Preis/Leistung stimmt nicht</option>
                    <option value="9">9 = Paket beschädigt</option>
                </select></td>
            <td>
                <div class="form-check">
                    <input class="form-check-input-sm" type="radio" name="exampleRadios{{$i}}" value="131" id="a-ware{{$i}}" >
                     <label class="form-check-label" for="a-ware{{$i}}"> A-Ware</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input-sm" type="radio" name="exampleRadios{{$i}}" value="132" id="b-ware{{$i}}" >
                     <label class="form-check-label" for="b-ware{{$i}}">B-Ware</label></div>
                <div class="form-check">
                    <input class="form-check-input-sm" type="radio" name="exampleRadios{{$i}}" value="defekt" id="defekt{{$i}}" >
                    <label class="form-check-label" for="defekt{{$i}}">Defekt</label>
                </div {{$id= $orderItem['billbee_id']}}>
            </td>
        </tr {{$i++}}>
        @endif
        @endif

        @endforeach
    </tbody>
</table>
<div class="input-box mb-2">
				<input id="bemerkung" type="text" class="d-block" >
				<p class="black">Bemerkungen</p>
<div class="d-flex receipt-buttons">
    <div>
        <button  class="main-btn" id="submit" value="{{$i-1}}" autofocus onclick="B2CReturebuchen(event)">
          Return buchen
        </button>
    </div>
    <div>
        <button class="main-btn mt-2 no-print" onclick="printOrdersAll()">DRUCKEN</button>
    </div>
    <div style="width:100%">
        <a href="/receipt/return" style="float: right;">
            <button class="main-btn mt-2 back no-print" value="{{$id}}" id="back"> Zurück</button>
        </a>
    </div>
</div>
@endsection
