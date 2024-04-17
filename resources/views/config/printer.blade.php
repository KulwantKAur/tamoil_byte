@extends("layouts.app")

@section("title", "Printer")
@section("content")



<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2>Druckereinstellungen</h2>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-2">
			<h4>Aktive Drucker</h4>
		</div>
		<div class="col-md-10">
			<table class="table">
				<tbody>
							<tr>
							<th scope="row">A4 DRUCKER</th>
							<th scope="row">DRUCKER ID</th>
							<th scope="row">AKTION</th>							
							</tr>

							@foreach($a4Printer as $item)
							<tr> 
							<td>{{$item->Druckername}}</td>
							<td>{{$item->Druckernummer01}}</td>

							<td>
								<div class="form-group">
									<a href ="{{url('configuration/printer/renamePrinter/' . $item->Druckernummer01 ) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Umbenennen</button>
												</a>
								</div>
								@if($item->Druckernummer01 != '9999')
								<div class="form-group">
									<a href ="{{url('configuration/printer/removePrinter/' . $item->Druckernummer01 ) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Löschen</button>
												</a>
								</div>
								@endif
							</td>
							</tr>
							@endforeach

							<tr>
							<th scope="row">LABEL DRUCKER</th>
							<th scope="row">DRUCKER ID</th>
							<th scope="row">AKTION</th>							
							</tr>

							@foreach($labelPrinter as $label)
							<tr> 
							<td>{{$label->Druckername}}</td>
							<td>{{$label->Druckernummer01}}</td>

							<td>
								<div class="form-group">
									<a href ="{{url('configuration/printer/renameLabel/' . $label->Druckernummer01 ) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Umbenennen</button>
												</a>
								</div>
								@if($label->Druckernummer01 != '9999')
								<div class="form-group">
									<a href ="{{url('configuration/printer/removeLabel/' . $label->Druckernummer01 ) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Löschen</button>
												</a>
								</div>
								@endif

							</td>
							</tr>
							@endforeach
				</tbody>
			</table>
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
		
		<div class="col-md-12">
			<h4>VERFÜGBARE DRUCKER IN DER DRUCKERWOLKE</h4>
			
			@if($data!= null)
				<div>
				<table class="table">
				<tbody>
				

							<tr>
							<th scope="row">DRUCKER</th>
							<th scope="row">DRUCKER ID</th>
							<th scope="row">ADD LABEL PRINTER</th>
							<th scope="row">ADD A4 PRINTER</th>
							
							</tr>

							@foreach($data as $printer)
							<tr> 
							<td>{{$printer->QueueName}}</td>
							<td>{{$printer->Id}}</td>
							<td>

								<div class="form-group">
									<a href ="{{url('configuration/printer/addLabel/' . $printer->Id) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Add</button>
												</a>
								</div>

							</td>
							<td>

								<div class="form-group">
									<a href ="{{url('configuration/printer/addPrinter/' . $printer->Id) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Add</button>
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
</div>

@endsection