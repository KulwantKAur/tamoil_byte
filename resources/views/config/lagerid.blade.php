@extends("layouts.app")

@section("title", "Configuration")
@section("content")



<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2>Lager ID's</h2>
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
			
			<form action="{{ url('configuration/lagerid/add') }}" method="POST" name="dateform"
				enctype="multipart/form-data">

				<div class="form-group">
					

					<input class="form-control" type="text" name="lagerid" placeholder="LagerID hier eintragen ...">
					<input class="form-control" type="text" name="name" placeholder="Name des Lagers...">

					</br>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Hinzufügen?">
					</div>

					@csrf
				</div>
				
				
			</form>

		</div>
		<div class="col-md-8">

			
			@if($data!= null)
				<div>
				<table class="table">
				<tbody>
				

							<tr>
							<th scope="row">LAGER ID</th>
							<th scope="row">NAME</th>
							<th></th>
							</tr>
							@foreach($data as $item)
							<tr> 
							<td>{{$item->lagerid}}</td>
							<td>{{$item->name}}</td>
							<td>

								<div class="form-group">
									<a href ="{{url('configuration/lagerid/remove/' . $item->lagerid) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Löschen</button>
												</a>
								</div>

							</td>
							</tr>
							@endforeach
							
							
						</tbody>
						</table>

				</div>
			@endif


		</div>
		
		<div class="col-md-4">
			<form action="{{ url('configuration/lagerid/discover') }}" method="POST" name="dateform"
				enctype="multipart/form-data">
				@csrf
				<input type="submit" class="btn btn-success" value="Finde Lager in Billbee">
			</form>
		</div>
		<div class="col-md-8">

			@isset($discovery)
				@if($discovery != null)
					<div class="row">
						<div class="col-md-6">
							<h6>Billbee StockId</h6>
						</div>
						<div class="col-md-6">
							<h6>Billbee Name</h6>
						</div>
					</div>
					@foreach($discovery as $item)
					<div class="row">
						<div class="col-md-6">
							{{$item['StockId']}}
						</div>
						<div class="col-md-6">
							{{$item['Name']}}
						</div>
					</div>
					@endforeach
				@endif
			@endisset
		</div>
	</div>
</div>

@endsection