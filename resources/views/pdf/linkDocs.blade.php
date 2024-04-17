<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>onamo Docs</title>
	<style>
	th,td{
	text-align:center;
	}
	</style>
</head>
<body>
	<div class="container-fluid">
	<div class="flex-between mt-2">
            <a href="/" class="back">
                <button class="btn btn-warning mt-4 mb-4">Home</button>
            </a>
			<a href="/quality" class="back" style="float: right;">
                <button class="btn btn-warning mt-4 mb-4">Nächste Bestellung</button>
            </a>
        </div>
	
        <div class="row">
		
			<div class="col-md-4">
				<table class="table">
					<thead>
						<tr><th>Shipping Docs</th></tr>
					</thead>
					<tbody>
                    @foreach($shipping_label as $key => $val)
                    <tr><td><a href="javascript:void(0)" data-encode="{{$val}}">Box {{$key + 1}}</a></td></tr>
                    @endforeach
					</tbody>
				</table>
			</div>
			
			<div class="col-md-4">
			@if($export_pdf)
				<table class="table">
					<thead>
						<tr><th>invoice Docs</th></tr>
					</thead>
					<tbody>
                    @foreach($invoice_pdf as $key => $val)
                    <tr><td><a href="javascript:void(0)" data-encode="{{$val}}">Box {{$key + 1}}</a></td></tr>
                    @endforeach
					</tbody>
				</table>
			@endif
			</div>
			
			<div class="col-md-4">
            @if($export_pdf)
				<table class="table">
					<thead>
						<tr><th>Export Docs</th></tr>
					</thead>
					<tbody>
					@foreach($export_pdf as $key => $val)
                    <tr><td><a href="javascript:void(0)" data-encode="{{$val}}">Box {{$key + 1}}</a></td></tr>
                    @endforeach
                    </tbody>
				</table>
			@endif
			</div>
			
			<div class="col-md-4">
            @if($delivery_pdf)
				<table class="table">
					<thead>
						<tr><th>Lieferschein</th></tr>
					</thead>
					<tbody>
					@foreach($delivery_pdf as $key => $val)
                    <tr><td><a href="javascript:void(0)" data-encode="{{$val}}">Box {{$key + 1}}</a></td></tr>
                    @endforeach
                    </tbody>
				</table>
			@endif
			</div>
			
        </div>

	</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script>
    $('a').click(function(){
        printJS({
            printable: $(this).data('encode'),
            type: 'pdf',
            base64: true,
        });
    });
    
    </script>
</body>
</html>