<!DOCTYPE html>
<html lang="en">
	<head>
	  	<title>@yield('title')</title>
	  	<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link href="{{URL('/')}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link href="{{URL('/')}}/assets/select2/dist/css/select2.min.css" rel="stylesheet" />
		<link href="{{URL('/')}}/assets/datatable/datatables.min.css" rel="stylesheet">
		<link href="{{URL('/')}}/assets/css/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
		<link href="{{URL('/')}}/assets/css/responsive-tabs.css" rel="stylesheet">
		<style>
			.select2-container--default .select2-selection--single{
		        height: 34px;
		        padding: 3px;
		    }
		</style>
		<style>
		.form-group {
		    margin-bottom: 15px;
		    padding: 0 1em;
		}

	    .alternative-font {
		    color: #0088cc;
		    font-family: "Shadows Into Light", cursive;
		    font-size: 1.6em;
		}
		</style>
		@yield('style')
	</head>
	<body>
		<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
	      <h5 class="my-0 mr-md-auto font-weight-normal">GABC Exam</h5>
	      @yield('menu')
	      
	    </div>
		<div class="container">
			<main class="main">
				@yield('content')
			</main>
		</div>


		<script src="{{URL('/')}}/assets/js/jquery-3.7.1.min.js"></script>
		<script src="{{URL('/')}}/assets/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="{{URL('/')}}/assets/select2/dist/js/select2.min.js"></script>
		<script src="{{URL('/')}}/assets/datatable/datatables.min.js"></script>
		<script src="{{URL('/')}}/assets/js/lib/dist/sweetalert.min1.js"></script>
		<script src="{{URL('/')}}/assets/js/responsive-tabs.js"></script>

		@yield('page-script')

	</body>
</html>
