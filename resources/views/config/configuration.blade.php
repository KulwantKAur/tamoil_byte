@extends("layouts.app")

@section("title", "Configuration")
@section("content")



<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<h2>Konfiguration der LagerApp</h2>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<a href="configuration/shopid">Billbee Shop ID's</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<a href="configuration/lagerid">Lager ID's</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<a href="configuration/general">Allgemeines</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<a href="/stasi">Bestellüberprüfung</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<a href="/eanignorelist">Ignore EAN Liste</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<a href="/configuration/printer">Drucker einrichten</a>
		</div>
	</div>

</div>

@endsection