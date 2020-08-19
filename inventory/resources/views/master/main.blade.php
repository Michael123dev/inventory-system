<!doctype html>
<html lang="en">

<head>
    <title>Dashboard | @yield('title')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admin/assets/img/favicon.png') }}">
	@yield('header')
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="{{asset('admin/assets/img/logo-dark.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				@yield('search')

				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{ Auth::user()->name }} </span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('logout') }}"
										onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										<i class="lnr lnr-exit"></i> <span>Logout</span></a>
									</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
									</form>
								</li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{ url('/') }}" class="@if($page == 'home') active @endif"><i class="lnr lnr-home"></i> <span></span>Dashboard</span></a></li>

						@if (auth()->user()->role == 'admin')
						<li><a href="{{ url('/customers') }}" class="@if($page == 'customers') active @endif"><i class="lnr lnr-users"></i> <span>Pelanggan</span></a></li>
						@endif

						@if (auth()->user()->role == 'admin')
						<li><a href="{{ url('/suppliers') }}" class="@if($page == 'suppliers') active @endif"><i class="lnr lnr-apartment"></i> <span>Pemasok</span></a></li>
						@endif

						@if (auth()->user()->role == 'admin')
						<li><a href="{{ url('/stocks') }}" class="@if($page == 'stocks') active @endif"><i class="lnr lnr-gift"></i> <span>Stok Barang</span></a></li>
						@endif

						@if (auth()->user()->role == 'admin')
						<li><a href="{{ url('/sales') }}" class="@if($page == 'sales') active @endif"><i class="lnr lnr-exit"></i> <span>Penjualan</span></a></li>
						@endif

						@if (auth()->user()->role == 'admin')
						<li><a href="{{ url('/purchases') }}" class="@if($page == 'purchases') active @endif"><i class="lnr lnr-cart"></i> <span>Pembelian</span></a></li>
						@endif

						@if (auth()->user()->role == 'admin')
						<li><a href="{{ url('/users') }}" class="@if($page == 'users') active @endif"><i class="lnr lnr-user"></i> <span>Manajemen User</span></a></li>
						@endif

					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			@yield('content')
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('admin/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{ asset('admin/assets/scripts/klorofil-common.js')}}"></script>
	@yield('footer')
	
</body>

</html>
