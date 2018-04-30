<!doctype html>
<html><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">

	<title>@yield('page-title') {{ env('APP_NAME') }}</title>
	<link REL="icon" HREF="/images/fav.png">

	<meta name="author" content="Harris Christiansen">
	<meta name="description" content="{{ env('APP_NAME') }} - Created by Harris Christiansen">
	<meta name="keywords" content="control, show, phillips, hue, smart, lights, animation, harris, christiansen, harrischristiansen, html5, php, laravel">
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- BValidator -->
	<link href="/css/plugins/bvalidator.css" rel="stylesheet" type="text/css">
	
	<!-- jQuery UI -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	
	<!-- Bootstrap IE8 Support -->
	<!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Fonts -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	
	<!-- Site CSS -->
	<link rel="stylesheet" type="text/css" href="/css/site.css">
	
	<!-- Spectrum Colorpicker - https://bgrins.github.io/spectrum/ -->
	<link rel='stylesheet' href='js/plugins/spectrum/spectrum.css' />

</head><body>

	<!-- ========== Navbar ========== -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME') }}s</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link btn-success" href="#" id="act_on">All On</a></li>
				<li class="nav-item"><a class="nav-link btn-danger" href="#" id="act_off">All Off</a></li>
				<li class="nav-item"><a class="nav-link btn-warning" href="#" id="act_flash">Flash</a></li>
				<li class="nav-item"><a class="nav-link btn-secondary" href="#" id="act_noEffects">No Effects</a></li>
				<li class="nav-item"><a class="nav-link btn-primary" href="#" id="act_colorloop">Colorloop</a></li>
				<li class="nav-item"><a class="nav-link {{ Request::route()->named('scenes') ? 'active':'' }}" href="{{ route('home') }}" id="act_flash">Scenes</a></li>
				<li class="nav-item"><a class="nav-link {{ Request::route()->named('about') ? 'active':'' }}" href="{{ route('about') }}" id="act_flash">About</a></li>
			</ul>
		</div>
	</nav>
	
	@if (session()->has('alert') || count($errors))
	<!-- ========== Alerts ========== -->
	<div id="alerts" class="container mt-3">
		@if (session()->has('alert'))
		<div class="alert {{ session()->get('alert-class', 'alert-success') }}" role="alert">{{ session()->get('alert') }}</div>
		<?php session()->forget('alert'); ?>
		@endif
		@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">{{ $error }}</div>
		@endforeach
	</div>
	@endif
	
	
	<!-- ========== Content ========== -->
	@yield('content')

	<!-- ========== Javascript ========== -->
	
	<!-- jQuery / jQuery UI -->
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/js/plugins/jquery.cookie.js"></script>
	
	<!-- BValidator -->
	<script type="text/javascript" src="/js/plugins/jquery.bvalidator-yc.js"></script>

	<!-- Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	
	<!-- Tablesorter -->
	<script type="text/javascript" src="/js/plugins/jquery.tablesorter.min.js"></script>
	
	<!-- Philips Hue API -->
	<script src="js/plugins/hue/colors.js"></script>
	<script src="js/plugins/hue/hue.js"></script>
	
	<!-- Spectrum Colorpicker - https://bgrins.github.io/spectrum/ -->
	<script src='js/plugins/spectrum/spectrum.js'></script>
	
	<!-- Site JS -->
	<script type="text/javascript" src="js/showcontrol.js"></script>
</body></html>