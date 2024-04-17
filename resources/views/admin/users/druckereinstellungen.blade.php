@extends('layouts.app')
<!-- view für das Editieren der User-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Druckereinstellungen</div>
                    <form  method="POST" action="{{ route('admin.druckerupdate',$user) }}">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Labeldrucker</button>
                                    </h2>

                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            @foreach ($label as $l )
                                            <div class="form-check">
                                                <input type="checkbox" name="label[]" value="{{$l->id}}"  @if($l->Druckernummer01==$user->labeldrucker) checked @endif>
                                                <label>{{ $l->Druckername}}</label>
                                            </div>@endforeach
                                        </div>
                                    </div>

                                    <div class="accordion-item" >
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"  aria-controls="flush-collapseTwo">
                                                A4 Dokumentendrucker</button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach ($a4 as $a4 )
                                                    <div class="form-check">
                                                        <input type="checkbox" name="a4[]" value="{{$a4->id}}" @if($a4->Druckernummer01==$user->a4drucker ) checked @endif>
                                                        <label>{{ $a4->Druckername}}</label>
                                                    </div>@endforeach
                                                </div>
                                            </div>
                                        </div>

                                        @csrf
                                        {{ method_field('GET') }}
                                        <button type="submit" class="btn btn-outline-primary">Update</button>
                                    </form>
                                    @can('Costumer-Support')
                                        <a href ="/" >
                                        <button type="button" class="btn btn-outline-primary">Zurück</button></a>
                                    @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endsection
