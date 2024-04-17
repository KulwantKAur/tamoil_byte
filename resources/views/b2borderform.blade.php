{{-- <!DOCTYPE html> --}}
@extends("layouts.app")
@section("title", "B2B Order Upload")
@section("content")

<!-- Page Content -->
<div class="container-fluid">

  	<h2 class="mt-4">B2B Bestell upload zu Billbee</h2>
	</br>

		<div class="row">

			<div class="col-sm">

				<form action="{{ url('b2buploadorder') }}" method="POST" name="importform"
				enctype="multipart/form-data">

					<div class="form-group">

						<input id="file" type="file" name="file" class="form-control">
						{{$errors->first('file')}}
						@csrf
					</div>

				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="b2b" value="61950" checked>
				  <label class="form-check-label" for="b2b">
					B2B
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="Warensendung" value="76305">
				  <label class="form-check-label" for="Warensendung">
					Warensendung
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="Marketing" value="76305">
				  <label class="form-check-label" for="Marketing">
					Marketing
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="radio" name="shopID" id="Test" value="79993">
				  <label class="form-check-label" for="Test">
					Test
				  </label>
				</div>
				</br>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="B2B Bestellung prüfen">
				</div>


			<div>
			<p>Link zum Bestell Upload template: <a href='/docs/2020_B2B_OrderFormUploadTemplate.xlsx'>==> HIER <== </a></p>
            </div>
             <a class="btn btn-outline-primary float-left mb-2" href="/" role="button">zurück</a>
			</div>

				@if(session('errors'))
				<div class="alert alert-warning alert-dismissible fade show" >
					{{ session('errors') }}
				</div>
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

			</div>
			</form>
		</div>

		@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}


		</div>
		@endif

			@if($orderdata!= null)
			<div><p>Jetzt Bestellung hochladen:</p><br/>
			<table class="table">
			<tbody>
			@foreach($orderdata as $data)

					@if ($loop->first)

						<tr>
						  <th scope="row">Kunde</th>
						  <td>{{$data['Kundenname']}}</td>
						</tr>
						<tr>
						  <th scope="row">Bestellnummer</th>
						  <td>{{$data['ExterneBestellnummer']}}</td>
						</tr>
					  </tbody>
					</table>


				<table class="table table-striped">
				  <thead>
					<tr>
					  <th scope="col">EAN</th>
					  <th scope="col">Produkt</th>
					  <th scope="col">Aktueller Bestand</th>
					  <th scope="col">Anzahl</th>
					  <th scope="col">Einzel Preis</th>
					  <th scope="col">Total</th>
					</tr>
				  </thead>
				  <tbody>
				  @endif
					<tr>
					  <th>{{$data['EAN']}} </th>
					  <td>{{$data['ProduktName']}}</td>
					  <td>{{$data['Bestand']}}</td>
					  <td>{{$data['Anzahl']}} </td>
					  <td>{{$data['PreisStück']}} </td>
					  <td></td>
					</tr>
				@endforeach
				  </tbody>
				</table>


			</div>
			@endif

            @if($splitorderdata != null)
            <div><p>Im System Hinterlegt für spätere Ausführung:</p><br/>
			<table class="table">
			<tbody>

			@foreach($splitorderdata as $orderdata)
				@if ($loop->first)

						<tr>
						  <th scope="row">Kunde</th>
						  <td>{{$orderdata['Kundenname']}}</td>
						</tr>
						<tr>
						  <th scope="row">Bestellnummer</th>
						  <td>{{$orderdata['ExterneBestellnummer']}}</td>
						</tr>
					  </tbody>
					</table>


				<table class="table table-striped">
				  <thead>
					<tr>
					  <th scope="col">EAN</th>
					  <th scope="col">Produkt</th>
					  <th scope="col">Aktueller Bestand</th>
					  <th scope="col">Anzahl</th>
					  <th scope="col">Einzel Preis</th>
					  <th scope="col">Total</th>
					</tr>
				  </thead>
				  <tbody>
				  @endif
					<tr>
					  <th>{{$orderdata['EAN']}} </th>
					  <td>{{$orderdata['ProduktName']}}</td>
					  <td>{{$orderdata['Bestand']}}</td>
					  <td>{{$orderdata['Anzahl']}} </td>
					  <td>{{$orderdata['PreisStück']}} </td>
					  <td></td>
					</tr>
				@endforeach
				  </tbody>
				</table>


			</div>
			@endif

			@if($splitorderdata != null || $orderdata != null)
			<form action="{{ url('b2bconfirmorder') }}" method="POST" name="importform"
				enctype="multipart/form-data">
				@csrf

				<div class="form-group">
					<input type="submit" class="btn btn-success" value="B2B Bestellung in Billbee laden">
				</div>

				<div class="form-check">
				  <input class="form-check-input" type="hidden" name="orderReference" id="Test" value={{$orderReference}}>
				</div>


			</form>
			@endif
	</div>
	@endsection
