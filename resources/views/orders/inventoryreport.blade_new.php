@extends("layouts.app")

@section("title", "Inventory Report")
@section("content")



<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2>Inventory Report</h2>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-4">
			@if($errors->any())
			<h4>{{$errors->first()}}</h4>
			@endif
		</div>
		<div class="col-md-8">
			
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			
			<form action="{{ url('inventoryReport/create') }}" method="POST" name="dateform"
				enctype="multipart/form-data">

				<div class="form-group">
					
                   <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="83730" id="shopid1" name="shopid1" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                        83730
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="77643" id="shopid2" name="shopid2" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        77643
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="94933" id="shopid3" name="shopid3" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        94933
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="91805" id="shopid4" name="shopid4" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        91805
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="77642" id="shopid5" name="shopid5" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        77642
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="77130" id="shopid6" name="shopid6" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        77130
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="91244" id="shopid7" name="shopid7" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        91244
                    </label>
                    </div>
                     <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="94821" id="shopid8" name="shopid8" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        94821
                    </label>
                    </div>
                     <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="68914" id="shopid9" name="shopid9" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        68914
                    </label>
                    </div>

					<!-- <input class="form-control" type="text" name="shopid" placeholder="Billbee Kanal / ShopID hier eintragen ...">
					<input class="form-control" type="text" name="name" placeholder="Name des Shops...">
					<input class="form-control" type="text" name="pickliste" placeholder="In welche Pickliste soll einsortiert werden...">

					<select class="form-control form-control-sm" name="status">
						<option name="status" id="Fulfillment" value="16">16 Fulfillment</option>
						<option name="status" id="Versendet" value="4" >4 Versendet</option>
						<option name="status" id="Gepackt" value="13">13 Angeboten</option>
						<option name="status" id="Mahnung" value="12">12 Mahnung</option>
						
					</select>
					<select class="form-control form-control-sm" name="lagerid">
						
					</select>
					<select class="form-control form-control-sm" name="retourenform">
						
						<option name="retourenform" id="kerbholz" value="kerbholz">onomao</option>
						<!-- <option name="retourenform" id="limango" value="limango">LIMANGO</option> -->
						<option name="retourenform" id="none" value="none">KEINES</option>

						
					</select> -->

					</br>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Erstelle Report">
					</div>

					@csrf
				</div>
				
				
			</form>

		</div>
	</div>
	<div class="row">

		<div class="col-md-10">
			
			<!-- @if($data!= null)
				<div>
				<table class="table">
				<tbody>
				

							<tr>
							<th scope="row">PICKLISTE</th>
							<th scope="row">SHOP ID</th>
							<th scope="row">NAME</th>
							<th scope="row">DEFAULT LAGER</th>
							<th scope="row">STATUS</th>
							<th scope="row">RETOURENFORM</th>
							<th scope="row">ORDERSYNC</th>
							<th></th>
							</tr>
							@foreach($data as $item)
							<tr> 
							<td>{{$item->pickliste}}</td>
							<td>{{$item->shopid}}</td>
							<td>{{$item->name}}</td>
							<td>{{$item->stockid}}</td>
							<td>{{$item->status}}</td>
							<td>{{$item->retourenform}}</td>
							<td>{{$item->sync}}</td>
							<td>

								<div class="form-group">
									<a href ="{{url('configuration/shopid/remove/' . $item->shopid) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Löschen</button>
												</a>
								</div>
								<div class="form-group">
									<a href ="{{url('configuration/shopid/change/' . $item->shopid) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Ändern</button>
												</a>
								</div>

							</td>
							</tr>
							@endforeach
							
							
						</tbody>
						</table>

				</div>
			@endif -->


		</div>
	</div>
</div>

@endsection