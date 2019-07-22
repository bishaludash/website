<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
{{-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>@yield('title')</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<!-- CSS Files -->
<link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin/css/paper-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
</head>
	<body class="">
	<div class="wrapper ">
	{{-- Sidebar --}}
	@include('backend.layouts.sidebar')

	<div class="main-panel">
		<!-- Navbar -->
		@include('backend.layouts.navbar')
		<!-- End Navbar -->
		
		<div class="content">
			@include('partials.flash')
			@yield('content')
		</div>

		<footer class="footer footer-black  footer-white ">
			<div class="container-fluid">
			<div class="row">
				<nav class="footer-nav">
				<ul>
					<li>
					<a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
					</li>
					<li>
					<a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
					</li>
					<li>
					<a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
					</li>
				</ul>
				</nav>

				<div class="credits ml-auto">
					<span class="copyright">
						&copy; {{date('Y')}} made with <i class="fa fa-heart heart"></i> by Creative Tim
					</span>
				</div>
			</div>
			</div>
		</footer>



	</div>  
	{{-- Main pannel end --}}
	</div>
	{{-- Wrapper end --}}

	{{-- Modal --}}
	@include('partials.modal')

	<!--   Core JS Files   -->
	<script src="{{asset('admin/js/core/jquery.min.js')}}"></script>
	<script src="{{asset('admin/js/core/popper.min.js')}}"></script>
	<script src="{{asset('admin/js/core/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/ajax_script.js')}}"></script>
	<script src="{{asset('admin/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

	<!-- Chart JS -->
	{{-- <script src="../assets/js/plugins/chartjs.min.js"></script> --}}
	<!--  Notifications Plugin    -->
	<script src="{{asset('admin/js/plugins/bootstrap-notify.js')}}"></script>
	<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="{{asset('admin/js/paper-dashboard.min.js?v=2.0.0')}}" type="text/javascript"></script>
	@yield('footer')
	</body>

</html>

