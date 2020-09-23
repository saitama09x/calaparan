<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('metas')
<link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		@section('topbar')
			@include('partials.navHeader')
		@show
		@section('sidebar')
			@include('partials.navSidebar')
		@show
		<div class="content-wrapper">

			<div class="content-header">
		      	<div class="container-fluid">
		      		@yield('content')
		      	</div>
		 	 </div>
		</div>
	</div>
<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/axios/axios.min.js') }}"></script>
@stack('scripts')
</body>
</html>