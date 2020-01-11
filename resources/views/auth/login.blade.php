<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="theme-color" content="#000" />
	<meta name="description" content="I'm a full-stack web developer with a passion for building beautiful things from scratch. I've been building websites and sass apps since 2017 and also have a Bachelor's degree in Computer Science. Bishal Udash Keggs budash">
	<title>Login</title>
	
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
	
	
	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		
		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}

	</style>
	<!-- Custom styles for this template -->
	<link href="{{asset('css/login.css')}}" rel="stylesheet">
</head>
<body class="text-center">
	
	{{Form::open(['method'=>'POST', 'action'=>'BE\UserAuthController@login','class'=>'form-signin'])}}
	<h3>Please Login</h3>	
		<div class="form-group">
			{!! Form::email('be_email', null, ['class'=>'form-control', 'placeholder'=>'Email address']) !!}
		
			{!! Form::password('be_password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
		</div>

		@include('partials.error')
		@include('partials.flash')
		
		{!! Form::submit('Sign In', ['class'=>'btn btn-primary form-control']) !!}
		<p class="mt-5 mb-3 text-muted">
			&copy; 2019 - {{date('Y')}}
		</p>
	{{Form::close()}}
	
</body>
</html>
