{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>B2B Order Upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body> --}}
    @extends("layouts.app") {{-- um die Navbar auch hier anzuzeigen --}}

@section("title", "B2B Order Upload")

@section("content")
<div class="container">
	<form action="{{ url('/import') }}" method="POST" name="importform" enctype="multipart/form-data">
	@if(session('errors'))
		@foreach($errors as $error)
			<li>{{$error}}</li>
		@endforeach
	@endif
	@if(session('success'))
	{{session('success')}}
	@endif
		<div class="form-group">
			<label for="file">File:</label>
			<input id="file" type="file" name="file" class="form-control">
			@csrf
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Order Upload">
		</div>
    </form>
    <a class="btn btn-outline-primary float-left mb-2" href="/" role="button">zurück</a>
</div>
@endsection
{{-- </body>
</html> --}}
