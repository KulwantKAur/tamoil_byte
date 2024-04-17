{{-- <!DOCTYPE html> --}}
@extends("layouts.app")
@section("title", "Store Order Upload")
@section("content")

<!-- Page Content -->
<div class="container-fluid">

  	<h2 class="mt-4">Store order upload zu Billbee</h2>
	</br>

		<div class="row">

			<div class="col-sm">
				

				<form action="{{ url('storeuploader') }}" method="POST" name="importform"
				enctype="multipart/form-data">

					<div class="form-group">

						<input id="file" type="file" name="file" class="form-control">
						{{$errors->first('file')}}
						@csrf
					</div>

				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="Store_Cologne" value="4711" checked>
				  <label class="form-check-label" for="Store_Cologne">
					Store Köln
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="Store_Berlin" value="4712">
				  <label class="form-check-label" for="Store_Berlin">
					Store Berlin
				  </label>
				</div>
				
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="Test_Store" value="4799">
				  <label class="form-check-label" for="Test_Store">
					Test Store
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
					<div class="alert alert-success"><h2>Store End-of-Day erfolgreich in Billbee hochgeladen.</h2></div>
				@endif

			<!-- <div class="col-sm">
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
							  <option name="status" id="Angeboten" value="14">Angeboten</option>
							  <option name="status" id="Bestellt" value="1" >Bestellt</option>
							  <option name="status" id="Fulfillment" value="16">Fulfillment</option>
							</select>
					  </td>
					</tr>
					<tr>
					  <td scope="row">Bestellung aufteilen, wenn Produkte nicht verfügbar?</td>
					  <td>
							<select class="form-control form-control-sm" name="split">
							  <option name="split" id="Ja" value="1">Ja</option>
							  <option name="split" id="Nein" value="2" >Nein</option>
							</select>
					  </td>
					</tr>
					<tr>
					  <td scope="row">Bestellung gegen welches Lager buchen?</td>
					  <td>
							<select class="form-control form-control-sm" name="lager">
							  <option name="lager" id="HH" value="131">Lager Hamburg</option>
							  <option name="lager" id="CGN" value="133" >Lager Köln</option>
							</select>
					  </td>
					</tr>
				  </tbody>
				</table>

			</div> -->
			</form>
		</div>

		@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}


		</div>
		@endif

			
	</div>
	@endsection
