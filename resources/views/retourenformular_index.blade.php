@extends("layouts.app")

@section("title", "B2B Export")
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

@section("content")




	<div class="content">
		<div class="title m-b-md">
			Rücksendeformular
		</div>
		<div>
		<form action="{{ url('retourenformpost') }}" method="POST" id="myform" enctype="multipart/form-data">

			<div class="form-group">
			
				<div class="form-row">
				<div class="form-group col-md-3"></div>
					<div class="form-group col-md-3">
					  <label for="shop_id">Choose Shop</label>
					  @if($shopIds)
					  <select id="shop_id" name="shop_id" class="form-control">
						@foreach($shopIds as $shopId)
						<option value="{{$shopId->shopid}}">{{$shopId->name}}</option>
						@endforeach
					  </select>
					  @endif
					</div>
					<div class="form-group col-md-3">
					  <label for="billbee_id">Billbee ID</label>
					  <input type="text" class="form-control" id="billbee_id" name="billbee_id">
					</div>
					<div class="form-group col-md-3"></div>
				</div>
				</br>

				{{$errors->first('file')}}
				@csrf
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Proceed">
            </div>
			
        </form>
		</div>

	</div>
	
	<script>
	
	$('#myform').submit(function() {
		showLoader();
		if(!document.getElementById('shop_id').value){
			showErrorInfo();
			document.getElementById('content_info').innerHTML = 'Shop is required.';
			hideLoader();
			return false;
		}
		
		if(!document.getElementById('billbee_id').value){
			showErrorInfo();
			document.getElementById('content_info').innerHTML = 'Billbee Id is required.';
			hideLoader();
			return false;
		}
	  
	  
	});
	</script>


@endsection
