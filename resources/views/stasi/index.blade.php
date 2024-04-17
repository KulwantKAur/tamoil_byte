@extends("layouts.app")

@section("title", "Stasi")


@section("content")


	

	<div class="content">
		<div>
			Die super informative Pr&uuml;fseite
		</div>
		<div>
		<form action="{{ url('stasiid') }}" method="POST" name="dateform"
			enctype="multipart/form-data">

			<div class="form-group">

				<input class="form-control" type="text" name="billbeeid" placeholder="BillbeeID">

				</br>

				{{$errors->first('file')}}
				@csrf
			</div>
			
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Was geschah mit der ID?">
			</div>
		</form>
		@if($erfolg)
			<br>
			<div class="alert alert-success">
				Billbee ID zurückgesetzt
			</div>
		@endif
		
		@if($data!= null)
			<div>
			<table class="table">
			<tbody>
			

						<tr>
						  <th scope="row">BillbeeID</th>
						  <td>{{$data->billbee_id}}</td>
						</tr>
						<tr>
						  <th scope="row">Bestellnummer</th>
						  <td>{{$data->OrderRef}}</td>
						</tr>
						<tr>
						  <th scope="row">Name</th>
						  <td>{{$data->user}}</td>
						</tr>
						<tr>
						  <th scope="row">Am</th>
						  <td>{{$data->created_at}}</td>
						</tr>
						<tr>
							<th scope="row">Zurücksetzen</th>
							<td><a href ="/stasi/{{$data->billbee_id}}" >
                            	<button type="button" class="btn btn-outline-primary float-right">JETZTE!</button></a>
							</td>
						</tr>
					  </tbody>
					</table>

			</div>
		@endif
		<!--
		<form action="{{ url('stasi') }}" method="POST" name="dateform"
			enctype="multipart/form-data">

			<div class="form-group">
				<label for="start">Start date:</label>

				<input type="date" id="startDateForm" name="startDateForm" min="2019-10-01">

				<label for="start">End date:</label>

				<input type="date" id="endDateForm" name="endDateForm"	min="2019-10-01">
				</br>

				{{$errors->first('file')}}
				@csrf
			</div>
			
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Export to Excel">
			</div>
		</form>
		-->
		</div>
		
	</div>       


@endsection