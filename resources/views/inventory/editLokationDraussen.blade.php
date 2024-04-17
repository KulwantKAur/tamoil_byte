@extends('layouts.app')
{{-- <!-- view für das Editieren der Lokation --> --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-mx-8">
            </div>  
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Lokation {{$product->products_name}}</div>

                    <div class="card-body">

                       <form  method="POST" action="/inventory/updateDraussen">
                        <div class="form-group row">
                            <label for="lokation" class="col-md-2 col-form-label text-md-right">Neue Lager Lokation:</label>

                            <div class="col-md-6">
                                <input id="lokation" type="text" class="form-control @error('lokation') is-invalid @enderror" name="lokation" value="{{ $product->products_stocklocation }}" required autofocus>
                                <input type="hidden" name="productId" value="{{$product->products_id}}">
                                @error('lokation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         @csrf
                       {{ method_field('POST') }}
                          <button type="submit" class="btn btn-outline-primary">Update</button>
                        <a href ="/inventoryDraussenComplete" >
                            <button type="button" class="btn btn-outline-primary">Zurück</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
