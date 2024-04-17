@extends("layouts.app")

@section("title", "EAN Ignore List")


@section("content")


	

	<div class="content">
		<div>
			<h2>Folgende EAN werden in der Pickliste und beim Versenden NICHT berücksichtigt</h2>
		</div>
		<br>
		<div>
		<form action="{{ url('eanignorelist/add') }}" method="POST" name="dateform"
			enctype="multipart/form-data">

			<div class="form-group">
				

				<input class="form-control" type="text" name="ean" placeholder="weitere EAN hinzufügen...">

				</br>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="EAN hinzufügen?">
				</div>

				@csrf
			</div>
			
			
		</form>

		@if($errors->any())
		<h4>{{$errors->first()}}</h4>
		@endif
		
		
		@if($data!= null)
			<div>
			<table class="table">
			<tbody>
			

						<tr>
						  <th scope="row">EAN</th>
						   <th scope="row">SKU</th>
						   <th scope="row">Titel</th>
						   <th scope="row">Löschen</th>
						</tr>
						@foreach($data as $item)
						<tr> 
						  <td>{{$item->ean}}</td>
						  <td>{{$item->sku}}</td>
						  <td>{{$item->title}}</td>
						  <td>

							<div class="form-group">
								<a href ="{{url('eanignorelist/' . $item->ean) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Löschen</button>
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
		
	</div>       


@endsection