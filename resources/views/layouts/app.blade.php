<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="AdminKit">
	<link rel="shortcut icon" href="{{ asset('img/parcel.png') }}" />

	<title>
		@stack('title')
	</title>

	<!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

	<link href="{{ asset('template/css/app.css') }}" rel="stylesheet">

	<style>
		.content {
			padding: 0.5rem 3rem 1.5rem;
		}

		.dt-buttons {
			display: none;
		}

		.card-title {
			color: #404040;
			font-size: 1.3rem;
		}

		.input-title {
			color: gray;
			font-weight: 500;
		}

		.input-show {
			color: black;
			font-weight: 600;
		}
	</style>

	@stack('style')
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">DP Center</span>
				</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>

					<li class="sidebar-item @if(Route::currentRouteName() == 'home') active @endif">
						<a class="sidebar-link" href="{{ route('home') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					@if (auth()->user()->id == 1)
						@hasanyrole('staff')
							<li class="sidebar-item @if(Route::currentRouteName() == 'student.index') active @endif">
								<a class="sidebar-link" href="{{ route('student.index') }}">
									<i class="align-middle" data-feather="user"></i> <span class="align-middle">Student</span>
								</a>
							</li>

							<li class="sidebar-item @if(Route::currentRouteName() == 'staff.index') active @endif">
								<a class="sidebar-link" href="{{ route('staff.index') }}">
									<i class="align-middle" data-feather="user"></i> <span class="align-middle">Staff</span>
								</a>
							</li>
							<li class="sidebar-item @if(Route::currentRouteName() == 'history.index') active @endif">
								<a class="sidebar-link" href="{{ route('history.index') }}">
									<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Payment</span>
								</a>
							</li>
						@endhasanyrole
					@endif

					@if (auth()->user()->id != 1)
						@hasanyrole('student|staff')
							<li class="sidebar-item @if(Route::currentRouteName() == 'track.index') active @endif">
								<a class="sidebar-link" href="{{ route('track.index') }}">
									<i class="align-middle" data-feather="user"></i> <span class="align-middle">Track & Trace</span>
								</a>
							</li>
							<li class="sidebar-item @if(Route::currentRouteName() == 'payment.index') active @endif">
								<a class="sidebar-link" href="{{ route('payment.index') }}">
									<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Payment</span>
								</a>
							</li>
							<li class="sidebar-item @if(Route::currentRouteName() == 'history.index') active @endif">
								<a class="sidebar-link" href="{{ route('history.index') }}">
									<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">History</span>
								</a>
							</li>
						@endhasanyrole
					@endif
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" onclick="toggleHighlight()" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-dark">{{ auth()->user()->name }}</span>
                            </a>
							<div id="dropdown-menu" class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ route('profile') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Log out') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<nav aria-label="breadcrumb" class="m-2 bg-light">
				<ol class="breadcrumb">
					@stack('breadcrumb')
				</ol>
			</nav>

            @yield('content')

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>DP Center</strong></a>&nbsp;&copy;
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('template/js/app.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

	<script>
		function toggleHighlight() {
			var dropdown = document.getElementById("dropdown-menu");
			dropdown.setAttribute('data-bs-popper', 'static');
			dropdown.classList.toggle("show");
		}
	</script>
	
	@stack('script')

</body>

</html>