@extends("layouts.app")

@section("title", "Configuration")
@section("content")



<div class="container-fluid">
	<form action="{{ url('configuration/general/update') }}" method="POST" name="dateform" enctype="multipart/form-data">
	@csrf

		<div class="row">
			<div class="col-md-12">
				<h2>Allgemeine Einstellungen der LagerApp</h2>
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

		@if($data!= null)
			
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="billbeeapikey" placeholder="..." value="{{$data->billbeeapikey}}">
					</div>
				</div>
				<div class="col-md-8">
					Billbee API KEY
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="billbeebaseurl" placeholder="..." value="{{$data->billbeebaseurl}}">
					</div>
				</div>
				<div class="col-md-8">
					Billbee Base URL
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="billbeeusername" placeholder="..." value="{{$data->billbeeusername}}">
					</div>
				</div>
				<div class="col-md-8">
					Billbee Username
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="password" name="billbeepassword" placeholder="..." value="{{$data->billbeepassword}}">
					</div>
				</div>
				<div class="col-md-8">
					Billbee Password
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="druckerwolkeapikey" placeholder="..." value="{{$data->druckerwolkeapikey}}">
					</div>
				</div>
				<div class="col-md-8">
					Druckerwolke API KEY
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="druckerwolkebaseurl" placeholder="..." value="{{$data->druckerwolkebaseurl}}">
					</div>
				</div>
				<div class="col-md-8">
				Druckerwolke Base URL
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="druckerwolkeusername" placeholder="..." value="{{$data->druckerwolkeusername}}">
					</div>
				</div>
				<div class="col-md-8">
				Druckerwolke Username
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="password" name="druckerwolkepassword" placeholder="..." value="{{$data->druckerwolkepassword}}">
					</div>
				</div>
				<div class="col-md-8">
				Druckerwolke Password
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="eCom_pickup_Shopid" placeholder="..." value="{{$data->eCom_pickup_Shopid}}">
					</div>
				</div>
				<div class="col-md-8">
					eCom_pickup_Shopid
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="local_pickup_id" placeholder="..." value="{{$data->local_pickup_id}}">
					</div>
				</div>
				<div class="col-md-8">
					local_pickup_id
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="ProductId_international" placeholder="..." value="{{$data->ProductId_international}}">
					</div>
				</div>
				<div class="col-md-8">
					ProductId_international
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="order_state_id" placeholder="..." value="{{$data->order_state_id}}">
					</div>
				</div>
				<div class="col-md-8">
					order_state_id
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="b2b_customer" placeholder="..." value="{{$data->b2b_customer}}">
					</div>
				</div>
				<div class="col-md-8">
					b2b_customer
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="b2b_customers_noExport" placeholder="..." value="{{$data->b2b_customers_noExport}}">
					</div>
				</div>
				<div class="col-md-8">
					b2b_customers_noExport
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="sent_order_state_id" placeholder="..." value="{{$data->sent_order_state_id}}">
					</div>
				</div>
				<div class="col-md-8">
					sent_order_state_id
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="credit_note_state_id" placeholder="..." value="{{$data->credit_note_state_id}}">
					</div>
				</div>
				<div class="col-md-8">
					credit_note_state_id
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="vorkasseId" placeholder="..." value="{{$data->vorkasseId}}">
					</div>
				</div>
				<div class="col-md-8">
					vorkasseId
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="fakeshopid" placeholder="..." value="{{$data->fakeshopid}}">
					</div>
				</div>
				<div class="col-md-8">
					fakeshopid
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="SellerPlatform" placeholder="..." value="{{$data->SellerPlatform}}">
					</div>
				</div>
				<div class="col-md-8">
					SellerPlatform
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="SellerShopName" placeholder="..." value="{{$data->SellerShopName}}">
					</div>
				</div>
				<div class="col-md-8">
					SellerShopName
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="SellerShopId" placeholder="..." value="{{$data->SellerShopId}}">
					</div>
				</div>
				<div class="col-md-8">
					SellerShopId
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="SellerID" placeholder="..." value="{{$data->SellerID}}">
					</div>
				</div>
				<div class="col-md-8">
					SellerID
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="inventory" placeholder="..." value="{{$data->inventory}}">
					</div>
				</div>
				<div class="col-md-8">
					inventory
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="retourenSupport" placeholder="..." value="{{$data->retourenSupport}}">
					</div>
				</div>
				<div class="col-md-8">
					retourenSupport
				</div>
			</div>																																																						
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="B2B_SellerID" placeholder="..." value="{{$data->B2B_SellerID}}">
					</div>
				</div>
				<div class="col-md-8">
					B2B_SellerID
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="retourenSupport" placeholder="..." value="{{$data->retourenSupport}}">
					</div>
				</div>
				<div class="col-md-8">
					retourenSupport
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					@if($data->B2B_acceptLossOfReturnRight)
					<div class="form-group">
						<select class="form-control form-control-sm" name="B2B_acceptLossOfReturnRight">
							<option name="B2B_acceptLossOfReturnRight" value="1" >Yes</option>
							<option name="B2B_acceptLossOfReturnRight" value="0" >No</option>
						</select>
					</div>
					@else
					<div class="form-group">
						<select class="form-control form-control-sm" name="B2B_acceptLossOfReturnRight">
							<option name="B2B_acceptLossOfReturnRight" value="0" >No</option>	
							<option name="B2B_acceptLossOfReturnRight" value="1" >Yes</option>
						</select>
					</div>
					@endif
				</div>
				<div class="col-md-8">
					B2B_acceptLossOfReturnRight
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="B2B_state" placeholder="..." value="{{$data->B2B_state}}">
					</div>
				</div>
				<div class="col-md-8">
					B2B_state
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="B2B_platform" placeholder="..." value="{{$data->B2B_platform}}">
					</div>
				</div>
				<div class="col-md-8">
					B2B_platform
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="B2B_shopName" placeholder="..." value="{{$data->B2B_shopName}}">
					</div>
				</div>
				<div class="col-md-8">
					B2B_shopName
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="B2B_id" placeholder="..." value="{{$data->B2B_id}}">
					</div>
				</div>
				<div class="col-md-8">
					B2B_id
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="B2B_default_stock_id" placeholder="..." value="{{$data->B2B_default_stock_id}}">
					</div>
				</div>
				<div class="col-md-8">
					B2B_default_stock_id
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					@if($data->B2B_dontAdjustStock)
					<div class="form-group">
						<select class="form-control form-control-sm" name="B2B_dontAdjustStock">
							<option name="B2B_dontAdjustStock" value="1" >Yes</option>
							<option name="B2B_dontAdjustStock" value="0" >No</option>
						</select>
					</div>
					@else
					<div class="form-group">
						<select class="form-control form-control-sm" name="B2B_dontAdjustStock">
							<option name="B2B_dontAdjustStock" value="0" >No</option>	
							<option name="B2B_dontAdjustStock" value="1" >Yes</option>
						</select>
					</div>
					@endif
				</div>
				<div class="col-md-8">
					B2B_dontAdjustStock
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					@if($data->RetourenLabel)
					<div class="form-group">
						<select class="form-control form-control-sm" name="RetourenLabel">
							<option name="RetourenLabel" value="1" >Yes</option>
							<option name="RetourenLabel" value="0" >No</option>
						</select>
					</div>
					@else
					<div class="form-group">
						<select class="form-control form-control-sm" name="RetourenLabel">
							<option name="RetourenLabel" value="0" >No</option>	
							<option name="RetourenLabel" value="1" >Yes</option>
						</select>
					</div>
					@endif
				</div>
				<div class="col-md-8">
					RetourenLabel
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="B2B_orderUploadDefaultShopId" placeholder="..." value="{{$data->B2B_orderUploadDefaultShopId}}">
					</div>
				</div>
				<div class="col-md-8">
					B2B_orderUploadDefaultShopId
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="taxRateB2B" placeholder="..." value="{{$data->taxRateB2B}}">
					</div>
				</div>
				<div class="col-md-8">
					taxRateB2B
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="retourenSupport" placeholder="..." value="{{$data->retourenSupport}}">
					</div>
				</div>
				<div class="col-md-8">
					retourenSupport
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					@if($data->B2BnettoUpload)
					<div class="form-group">
						<select class="form-control form-control-sm" name="B2BnettoUpload">
							<option name="B2BnettoUpload" value="1" >Yes</option>
							<option name="B2BnettoUpload" value="0" >No</option>
						</select>
					</div>
					@else
					<div class="form-group">
						<select class="form-control form-control-sm" name="B2BnettoUpload">
							<option name="B2BnettoUpload" value="0" >No</option>	
							<option name="B2BnettoUpload" value="1" >Yes</option>
						</select>
					</div>
					@endif
					
				</div>
				<div class="col-md-8">
					B2BnettoUpload
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					
					@if($data->stuecklisteReverseLogic)
					<div class="form-group">
						<select class="form-control form-control-sm" name="stuecklisteReverseLogic">
							<option name="stuecklisteReverseLogic" value="1" >Yes</option>
							<option name="stuecklisteReverseLogic" value="0" >No</option>
						</select>
					</div>
					@else
					<div class="form-group">
						<select class="form-control form-control-sm" name="stuecklisteReverseLogic">
							<option name="stuecklisteReverseLogic" value="0" >No</option>	
							<option name="stuecklisteReverseLogic" value="1" >Yes</option>
						</select>
					</div>
					@endif
				</div>
				<div class="col-md-8">
					stuecklisteReverseLogic
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input class="form-control" type="text" name="techSupport" placeholder="..." value="{{$data->techSupport}}">
					</div>
				</div>
				<div class="col-md-8">
					techSupport
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">

					@if($data->sortOrdersBy == "location")
					<div class="form-group">
						<select class="form-control form-control-sm" name="sortOrdersBy">
							<option name="sortOrdersBy" value="location" >Lokation</option>
							<option name="sortOrdersBy" value="ean" >EAN</option>
							<option name="sortOrdersBy" value="sku" >SKU</option>
						</select>
					</div>
					@elseif($data->sortOrdersBy == "ean")
					<div class="form-group">
						<select class="form-control form-control-sm" name="sortOrdersBy">
							<option name="sortOrdersBy" value="ean" >EAN</option>	
							<option name="sortOrdersBy" value="location" >Lokation</option>
							<option name="sortOrdersBy" value="sku" >SKU</option>
						</select>
					</div>
					@elseif($data->sortOrdersBy == "sku")
					<div class="form-group">
						<select class="form-control form-control-sm" name="sortOrdersBy">
							<option name="sortOrdersBy" value="sku" >SKU</option>
							<option name="sortOrdersBy" value="ean" >EAN</option>	
							<option name="sortOrdersBy" value="location" >Lokation</option>
						</select>
					</div>
					@endif

				</div>
				<div class="col-md-8">
					sortOrdersBy
				</div>
			</div>	


		@endif

		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Update?">
		</div>
	</form>
</div>

@endsection