<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Nov 2020 03:58:59 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>@yield('title')</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
		
		<link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
		<link rel="manifest" href="{{ asset('/manifest.json') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		   <style>
			body {
			-moz-transform: scale(0.8, 0.8); /* Moz-browsers */
			zoom: 0.8; /* Other non-webkit browsers */
			zoom: 80%; /* Webkit browsers */
		}
		.slimScrollDiv{
			overflow:  visible !important;
		}
		.sidebar-inner{
			overflow:  visible !important;
		}
		#c{
			font-size: 28px;
			font-weight: bold;
		}
		</style>
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
		
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="/dashboard" class="logo">
						<span id="c">Refining</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('assets/img/favicon.png') }}" alt="Logo">
					</a>
					<a href="/dashboard" class="logo logo-small">
						{{-- //<img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30"> --}}
						<img src="{{ asset('assets/img/favicon.png') }}" alt="Logo">
					</a>
                </div>
				<!-- /Logo -->
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				
				{{-- <div class="top-nav-search">
					<form>
						<input type="text" class="form-control" placeholder="Search here">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				 --}}
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">

					
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" width="31" alt="Ryan Taylor"></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" alt="User Image" class="avatar-img rounded-circle">
								</div>
								{{-- <div class="user-text">
									<h6>{{ Auth::user()->first_name }}{{ " " }}{{ Auth::user()->last_name }}</h6>
									<p class="text-muted mb-0">@if (Auth::user()->hasrole('admin'))
										{{ "Admin" }}
									@else
										{{ "User" }}
									@endif</p>
								</div> --}}
							</div>
							<a class="dropdown-item" href="/profile">My Profile</a>
							<a class="dropdown-item" href="/change_password">Password</a>
						
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
						  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							  @csrf   
						  </form>
						
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li id="d"> 
								<a href="dashboard"><i class="fa fa-dashboard"></i> 
									<span>Dashboard</span></a>
							</li>
							<li> 
								<a href="/itemdata"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Items</span></a>
							</li>
							
							<li> 
								<a href="/invoice"><i class="far fa-file-invoice"></i> <span>Invoices</span></a>
							</li>
							@hasrole('admin')
							<li> 
								<a href="/viewhistory"><i class="fa fa-history" aria-hidden="true"></i><span>View History</span></a>
							</li>
							<li class="submenu">
								<a href="#"><i class="fa fa-user" aria-hidden="true"></i>
									<span> User Management</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="/ajaxdata">Users</a></li>
									<li><a href="/roles">Roles</a></li>
									<li><a href="/permissions">Permissions</a></li>
								</ul>
							</li>
							@endhasrole
							<li>
						
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i><span>
								{{ __('Logout') }}</span>
								
						  </a>
						  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							  @csrf   
						  </form>
							 
							</li>
							
						</ul>
					
						
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					

                   


					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">@yield('headername')</h3>
								<ul class="breadcrumb">
									
									<li class="breadcrumb-item active">@yield('sidebar')</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					
                    @yield('content')
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        {{-- <script src="{{  }}"></script> --}}
		
		<!-- Slimscroll JS -->
        <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
		
		<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>    
		<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>  
		<script src="{{ asset('assets/js/chart.morris.js') }}"></script>
		
		<!-- Custom JS -->
		<script  src="{{ asset('assets/js/script.js') }}"></script>
		{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="{{ asset('/sw.js') }}"></script>

	@yield('scripts')


    </body>
	<script>
		 $(document).ready(function () {
        var url = window.location;
    // Will only work if string in href matches with location
        $('.sidebar a[href="' + url + '"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
        $('.sidebar a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');

        });

		   if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
	</script>
<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Nov 2020 04:02:56 GMT -->
</html>