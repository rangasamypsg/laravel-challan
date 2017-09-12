<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
	
	<link rel="stylesheet" href="{{ asset('libs/bower/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/misc-pages.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<body class="simple-page">
	<!--<div id="back-to-home">
		<a href="index.html" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
	</div>-->
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="index.html">
				<!--<span><i class="fa fa-gg"></i></span>-->
				<span>Login</span>
			</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center">Sign In Bradken Account</h4>
	<!-- <form action="#">
		<div class="form-group">
			<input id="sign-in-email" type="email" class="form-control" placeholder="Email">
		</div>

		<div class="form-group">
			<input id="sign-in-password" type="password" class="form-control" placeholder="Password">
		</div>

		<div class="form-group m-b-xl">
			<div class="checkbox checkbox-primary">
				<input type="checkbox" id="keep_me_logged_in"/>
				<label for="keep_me_logged_in">Keep me signed in</label>
			</div>
		</div>
		<input type="submit" class="btn btn-primary" value="SING IN">
	</form> -->
	
	<form  method="POST" action="{{ route('login') }}">
		{{ csrf_field() }}
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<!--<label for="email" class="col-md-4 control-label">E-Mail Address</label>

			<div class="col-md-6"> -->
				<input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" _required autofocus>

				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			<!--</div>-->
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<!--<label for="password" class="col-md-4 control-label">Password</label>

			<div class="col-md-6"> -->
				<input id="password" type="password" class="form-control" placeholder="Password" name="password" _required>

				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			<!--</div>-->
		</div>

		<!--<div class="form-group m-b-xl">
			<div class="checkbox checkbox-primary">
				<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
				<label for="keep_me_logged_in">Keep me signed in</label>
			</div>
		</div> -->
		<div class="form-group m-b-xl">
			<div>				
				<p class="pull-right"><a href="{{ URL::to('register') }}"><i class="fa fa-sign-in" aria-hidden="true"></i><label for="sign_up">&nbsp;&nbsp;Create an New Account</label></a></p>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">
				<i class="fa fa-paper-plane"></i>&nbsp;&nbsp;SIGN IN
		</button>
	</form>
	
</div><!-- #login-form -->

<!--<div class="simple-page-footer">
	<p><a href="password-forget.html">FORGOT YOUR PASSWORD ?</a></p>
	<p>
		<small>Don't have an account ?</small>
		<a href="signup.html">CREATE AN ACCOUNT</a>
	</p>
</div>--><!-- .simple-page-footer -->

</div><!-- .simple-page-wrap -->
</body>
</html>