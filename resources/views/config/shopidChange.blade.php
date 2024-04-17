@extends("layouts.app")

@section("title", "Configuration")
@section("content")



<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2>Change Shop ID</h2>
		</div>
		
	</div>

	<div class="row">
		
		<div class="col-md-12">

		<div class="card">
				<div class="card-header">Change Shop Data {{$shopid}}</div>

                    <div class="card-body">

                       <form  method="POST" action="{{action('Configuration\ConfigurationController@shopidChangeApply')}}">
					
						   @method('PUT')
                        <div class="form-group row">
                            <label for="shopid" class="col-md-2 col-form-label text-md-right">Billbee Shop ID</label>
                            <div class="col-md-8">
                                <input id="shopid" type="text" class="form-control " name="shopid" value="{{ $shopid }}" required autofocus>
                            </div>
						</div>
						<div class="form-group row">
							<label for="shopid" class="col-md-2 col-form-label text-md-right">Name</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control " name="name" value="{{ $name }}">
                            </div>
                        </div>
						<div class="form-group row">
							<label for="pickliste" class="col-md-2 col-form-label text-md-right">Pickliste</label>
                            <div class="col-md-8">
                                <input id="pickliste" type="text" class="form-control" name="pickliste" value="{{ $pickliste }}">
                            </div>
                        </div>
						<div class="form-group row">
							<label for="retourenform" class="col-md-2 col-form-label text-md-right">Retourenform</label>
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" name="retourenform">
						
									<option name="retourenform" id="kerbholz" value="kerbholz">KERBHOLZ</option>
									<option name="retourenform" id="limango" value="limango">LIMANGO</option>
									<option name="retourenform" id="none" value="none">KEINES</option>

									
								</select>
                            </div>
                        </div>
						<div class="form-group row">
							<label for="status" class="col-md-2 col-form-label text-md-right">Status</label>
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" name="status">
									<option name="status" id="Fulfillment" value="16">16 Fulfillment</option>
									<option name="status" id="Versendet" value="4" >4 Versendet</option>
									<option name="status" id="Gepackt" value="13">13 Angeboten</option>
									<option name="status" id="Mahnung" value="12">12 Mahnung</option>
									
								</select>
                            </div>
                        </div>
						<div class="form-group row">
							<label for="sync" class="col-md-2 col-form-label text-md-right">OrderSync</label>
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" name="sync">
									<option name="sync" id="yes" value="yes">Yes</option>
									<option name="sync" id="no" value="no" >No</option>
									
								</select>
                            </div>
                        </div>
						<!-- <div class="form-group row">
							<label for="stockid" class="col-md-2 col-form-label text-md-right">LagerOrt</label>
                            <div class="col-md-8">
                                <select class="form-control form-control-sm" name="lagerid">
									@foreach($lagerids as $lagerid)
									<option name="lagerid" id="{{$lagerid->name}}" value="{{$lagerid->lagerid}}">{{$lagerid->name}}, {{$lagerid->lagerid}}</option>
									@endforeach
								</select>
                            </div>
                        </div> -->
                         @csrf
                       {{ method_field('POST') }}
                          <button type="submit" class="btn btn-outline-primary">Umbenennen</button>
                        <a href ="/configuration/shopid" >
                            <button type="button" class="btn btn-outline-primary">Zurück</button></a>
				</div>
			</div>
			
			



			
		</div>
	</div>
</div>
	

@endsection