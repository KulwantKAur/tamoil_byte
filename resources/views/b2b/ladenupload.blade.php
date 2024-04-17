{{-- <!DOCTYPE html> --}}
@extends("layouts.app")
@section("title", "Laden Upload")
@section("content")

<!-- Page Content -->
<div class="container-fluid">

  	<h2 class="mt-4">Laden Bestückung in Billbee einspielen</h2>
	</br>

		<div class="row">

			<div class="col-sm">
				

				<form action="{{ url('ladenuploader') }}" method="POST" name="importform"
				enctype="multipart/form-data">

					<div class="form-group">

						<input id="file" type="file" name="file" class="form-control">
						{{$errors->first('file')}}
						@csrf
					</div>

				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="Store_Cologne" value="94821" checked>
				  <label class="form-check-label" for="Store_Cologne">
					Store Köln
				  </label>
				</div>
				</br>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Store Upload prüfen">
				</div>


			
             <a class="btn btn-outline-primary float-left mb-2" href="/" role="button">zurück</a>
			</div>

				@if(session('errors'))
				<div class="alert alert-warning alert-dismissible fade show" >
					{{ session('errors') }}
				</div>
				@endif

				@if($success)
					<div class="alert alert-success"><h2>Laden Bestückung erfolgreich in Billbee hochgeladen.</h2></div>
				@endif

			<div class="col-sm">
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th scope="col">Weitere Einstellungen</th>
					  <th scope="col"></th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td scope="row">Bestellung anlegen im Status</td>
					  <td>

						    <select class="form-control form-control-sm" name="status">
							<option name="status" id="Bestellt" value="1" >Bestellt</option>  
							<option name="status" id="Angeboten" value="14">Angeboten</option>
							<!-- <option name="status" id="Fulfillment" value="16">Fulfillment</option> -->
							</select>
					  </td>
					</tr>
					<!-- <tr>
					  <td scope="row">Bestellung aufteilen, wenn Produkte nicht verfügbar?</td>
					  <td>
							<select class="form-control form-control-sm" name="split">
							  <option name="split" id="Ja" value="1">Ja</option>
							  <option name="split" id="Nein" value="2" >Nein</option>
							</select>
					  </td>
					</tr> -->
					<tr>
					  <td scope="row">Bestellung gegen welches Lager buchen?</td>
					  <td>
							<select class="form-control form-control-sm" name="lager">
							<option name="lager" id="Laden" value="172" >Laden Köln</option>
							<!--<option name="lager" id="OWL" value="171" >Lager OWL</option> -->
							</select>
					  </td>
					</tr>
				  </tbody>
				</table>

			</div>
			</form>
		</div>

		@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}


		</div>
		@endif

			
	</div>
	@endsection
