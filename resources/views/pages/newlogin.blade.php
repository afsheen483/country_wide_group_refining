<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Nov 2020 04:05:09 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Login</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<style>
			#name{
				color: white;
				font-size: 30px;
			}
		</style>
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img src="{{ asset('assets/img/favicon.png') }}" alt="" height="200px" width="100px">
							{{-- <p id="name">Country Wide Refining
							</p> --}}
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								
								<!-- Form -->
								<form method="POST" action="{{ route('login') }}" class="user">
									@csrf
									<div class="form-group">
									
										<input id="email" type="text" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Username or Email...">
								   
								  @error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror 
			
								</div>
									<div class="form-group">
										<input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
										@error('password')
													  <span class="invalid-feedback" role="alert">
														  <strong>{{ $message }}</strong>
													  </span>
												  @enderror 
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit">Login</button>
									</div>
								</form>
								<!-- /Form -->
								
								<div class="text-center forgotpass"><a class="small" href="{{ route('password.request') }}">Forgot Password?</a></div>
								{{-- <div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div> --}}
								  
								<!-- Social Login -->
								{{-- <div class="social-login">
									<span>Login with</span>
									<a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a>
								</div> --}}
								<!-- /Social Login -->
								
								{{-- <div class="text-center dont-have">Don’t have an account? <a href="register.html">Register</a></div> --}}
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{ asset('assets/js/script.js') }}"></script>
		
    </body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Nov 2020 04:05:11 GMT -->
</html>