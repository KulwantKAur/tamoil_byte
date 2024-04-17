@extends('layouts.app')
{{-- <!-- view für das Editieren der Lokation --> --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Lokation {{$product->title}}</div>

                    <div class="card-body">

                       <form  method="POST" action="{{route('inventory.update',$product)}}">
                        <div class="form-group row">
                            <label for="lokation" class="col-md-2 col-form-label text-md-right">Lokation</label>

                            <div class="col-md-6">
                                <input id="lokation" type="text" class="form-control @error('lokation') is-invalid @enderror" name="lokation" value="{{ $product->stock_code }}" required autofocus>

                                @error('lokation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         @csrf
                       {{ method_field('PUT') }}
                          <button type="submit" class="btn btn-outline-primary">Update</button>
                        <a href ="/inventory" >
                            <button type="button" class="btn btn-outline-primary">Zurück</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
