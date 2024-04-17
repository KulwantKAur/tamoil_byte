{{-- <!DOCTYPE html> --}}
@extends("layouts.app")
@section("title", "B2B Order Sync")
@section("content")

        <div class="flex-center position-ref full-height ">
            

            <div>
				@if($erfolg)
					<div class="d-flex justify-content-center"><h2>B2B Sync Job erfolgreich durchgeführt.</h2></div>
				@endif

				<div class="d-flex justify-content-center">
				@foreach($dataArray as $data)
					
						@if ($loop->first)
						<table>
						<tr>
							<p>A total of {{$data['orderCounter']}} B2B Orders have been uploaded to Billbee.</p>
						</tr>
						</table>
						@endif
					
				@endforeach
				</div>
				<div class="d-flex justify-content-center table-responsive">
				@if($dataArray)
					<table class="table table-striped">
						<tr>
							<th scope="col">Order Number</td>
							<th scope="col">Customer Name</td>
						</tr>					

					@foreach($dataArray as $data)
					
							<tr>
								<td>{{$data['orderNumber']}}</td>
								<td class="text-right">{{$data['orderName']}}</td>
							</tr>
						
					@endforeach
					
					</table>
					
				@endif
				</div>
            </div>
        </div>

@endsection