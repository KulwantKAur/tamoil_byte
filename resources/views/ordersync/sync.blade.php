@extends("layouts.app")
@section("title", "Billbee Order Sync")

@section("content")
        <div class="flex-center position-ref full-height">
            

            <div class="content">
                <div class="title d-flex justify-content-center">
                    <h2>Order Sync Job</h2>
                </div>
				@if($erfolg)
					<div class="d-flex justify-content-center">Sync Job erfolgreich durchgeführt.</div>
				@endif
				@if($count)
					<div class="d-flex justify-content-center">{{$count}} orders synchronized.</div></br>
				@endif
                <br/>

            </div>
        </div>
@endsection
