@extends("layouts.app")

@section("title", "B2C Export")
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
			B2C Order Export
		</div>
		<div>
		<form action="{{ url('b2cexport') }}" method="POST" name="dateform"
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
        <a href="/" >
                <button class="btn btn-warning mt-2 back no-print float-left">Zurück</button>
            </a>
		</div>

	</div>


@endsection
