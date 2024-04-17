@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="main-container pt-10 pb-10">
         {{-- <div class="d-flex shop-ids">
             <div>
                @can('Lager')
                <input type="radio" id="shopId1" name="shopId" value="b2c" {{$shopId == "b2c" ? "checked" : ""}} onchange="handleUpdateShopId(event)">
                <label for="shopId1">B2C: Shopify - Avocado</label>
                @endcan
            </div>
            <div>@can('Lager')
                <input type="radio" id="shopId2" name="shopId" value="b2b" {{$shopId == "b2b" ? "checked" : ""}} onchange="handleUpdateShopId(event)">
                <label for="shopId2">B2B</label>@endcan
            </div>
            <div>@can('Lager')
                <input type="radio" id="shopIdamazon" name="shopId" value="amazon" {{$shopId == "amazon" ? "checked" : ""}} onchange="handleUpdateShopId(event)">
                <label for="shopIdamazon">Amazon</label>@endcan
            </div>
            <div>@can('Lager')
                <input type="radio" id="shopIdreklamation" name="shopId" value="reklamation" {{$shopId == "reklamation" ? "checked" : ""}} onchange="handleUpdateShopId(event)">
                <label for="shopIdreklamation">Reklamation - Warensendung - Ausbuchen</label> @endcan
            </div>
        </div> --}}
        <div class="text-center">
            <h2> Homepage </h2>
        </div>
    </div>
@endsection
