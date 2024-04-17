@extends("layouts.app")

@section("title", "Printer")
@section("content")


<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Drucker umbenennen {{$printerName}}</div>

                    <div class="card-body">

                       <form  method="POST" action="{{action('Configuration\ConfigurationController@printerRenameLabelApply')}}">
					
						   @method('PUT')
                        <div class="form-group row">
                            <label for="printerName" class="col-md-2 col-form-label text-md-right">Neue Bezeichnung</label>
                            <div class="col-md-6">
                                <input id="printerName" type="text" class="form-control @error('printerName') is-invalid @enderror" name="printerName" value="{{ $printerName }}" required autofocus>
								<input id="printerId" type="hidden" name="printerId" value="{{ $printerId }}">
								<input id="printerType" type="hidden" name="printerType" value="{{ $type }}">

                                @error('printerName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         @csrf
                       {{ method_field('POST') }}
                          <button type="submit" class="btn btn-outline-primary">Umbenennen</button>
                        <a href ="/configuration/printer" >
                            <button type="button" class="btn btn-outline-primary">Zurück</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection