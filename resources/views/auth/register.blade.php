<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bradkan - SignUp</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">	
	<link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
	
	<link rel="stylesheet" href="{{ asset('libs/bower/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/misc-pages.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<div id="back-to-home">
		<a href="{{ URL::to('login') }}" class="btn btn-outline btn-default" title="Back to Login"><i class="fa fa-home animated zoomIn"></i></a>
	</div>
<body class="simple-page">
	<div class="simple-page-wrap">				
		<div class="simple-page-form animated flipInY" id="signup-form">
			<a href="{{ URL::to('login') }}" title="Back to Login"><i class="fa fa-remove pull-right"></i></a>
			<h4 class="form-title m-b-xl text-center">Sign Up For a new Account</h4>
			<!--<form action="#">
				<div class="form-group">
					<input id="sign-up-name" type="text" class="form-control" placeholder="Name">
				</div>

				<div class="form-group">
					<input id="sign-up-email" type="email" class="form-control" placeholder="Email">
				</div>

				<div class="form-group">
					<input id="sign-up-password" type="password" class="form-control" placeholder="Password">
				</div>
				<div class="form-group">
					<input id="sign-up-password1" type="password1" class="form-control" placeholder="Confirm Password">
				</div>
				<input type="submit" class="btn btn-primary" value="SING IN">
			</form> -->
			
			<form method="POST" action="{{ route('register') }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<input id="name" type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" _required autofocus>
					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
				
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" _required>
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif				   
				</div>
				
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<input id="password" type="password" class="form-control" placeholder="Password" name="password" _required>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
                </div>
				
				<div class="form-group">
					<input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" _required>
					@if ($errors->has('password-confirm'))
						<span class="help-block">
							<strong>{{ $errors->first('password-confirm') }}</strong>
						</span>
					@endif
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Register
					</button>
				</div>				
			</form>
			
		</div><!-- #login-form -->
	</div><!-- .simple-page-wrap -->
</body>
</html>