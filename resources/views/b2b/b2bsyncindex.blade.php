{{-- <!DOCTYPE html> --}}
@extends("layouts.app")
@section("title", "B2B Order Upload")
@section("content")

<!-- Page Content -->
<div class="container-fluid">

  	<h2 class="mt-4">B2B Bestellungen aus <a href="https://www.dropbox.com/home/Apps/B2BUploadApp">Dropbox</a> Uploadfolder in Billbee laden </h2>
	</br>

		<div class="row">

			<div class="col-sm">
			@if($orderdata!= null)
			<div><br/>
			<table class="table">
			<tbody>
			<tr>
				<th scope="row">Kunde</th>
				<th scope="row">Bestellnummer</th>
			</tr>
			
			@foreach($orderdata as $data)
				
					@foreach($data as $set)
				
				
					@if ($loop->first)

						<tr>
						  
						  <td>{{$set['kundennummer']}}</td>
						  <td>{{$set['externebestellnummer']}}</td>
						</tr>
					  
					@endif
					@endforeach
				

			@endforeach
			</tbody>
			</table>
			@endif
            </div>

			<form action="{{ url('b2bsync') }}" method="GET" name="link"
			enctype="multipart/form-data">

					@csrf

			
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="B2B Bestellungen JETZT synchronisieren">
				</div>

				@if(session('errors'))
				<div class="alert alert-warning alert-dismissible fade show" >
					{{ session('errors') }}
				</div>
				@endif

			
			</form>
			</div>
		</div>

		@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}


		</div>
		@endif
	</div>
	@endsection
