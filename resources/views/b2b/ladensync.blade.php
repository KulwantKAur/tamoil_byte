{{-- <!DOCTYPE html> --}}
@extends("layouts.app")
@section("title", "Store Daily Sync")
@section("content")

        <div class="flex-center position-ref full-height ">
            

            <div>
				@if($erfolg)
					<div class="d-flex justify-content-center"><h2>Nachlieferung erfolgreich in Billbee hochgeladen.</h2></div>
				@endif

				<div class="d-flex justify-content-center">
				@foreach($dataArray as $data)
					
						@if ($loop->first)
						<table>
						<tr>
							<p>A total of {{$data['orderCounter']}} store orders have been uploaded to Billbee.</p>
						</tr>
						</table>
						@endif
					
				@endforeach
				</div>
				<div class="d-flex justify-content-center table-responsive">
				@if($dataArray)
					<table class="table table-striped">
						<tr>
							<th scope="col">Order Count</td>
							<th scope="col">Store Name</td>
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