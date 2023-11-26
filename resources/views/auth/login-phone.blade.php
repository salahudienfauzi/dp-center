<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="AdminKit">
	<link rel="shortcut icon" href="{{ asset('img/parcel.png') }}" />

	<title>Sign In | DP Center</title>

	<link href="{{ asset('template/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            background-image: url('/template/img/login1.jpeg');
            background-repeat: no-repeat;
             background-size: cover;
        }
    </style>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
                                    <div class="text-center mt-4">
                                        <h1 class="h2">Welcome to DP Center!</h1>
                                        <p class="lead">
                                            Login to your account to continue
                                        </p>
                                    </div>
									@if ($message = Session::get('success'))
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											{{ $message }}
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									@endif

									@if ($message = Session::get('error'))
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											{{ $message }}
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									@endif
                                    <hr>
                                    <form method="POST" action="{{ route('login.phone') }}">
                                    @csrf
										<div class="mb-3">
											<label class="form-label">Phone Number</label>
											<div class="input-group mb-2">
												<div class="input-group-prepend">
												<div class="input-group-text">MY +60</div>
												</div>
												<input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter your phone number">
												@error('phone_number')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter your password" />
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Login</button>
										</div>
									</form>
									<div class="text-center mt-3">
										Log in with email? <a href="{{ route('login') }}">Click Here</a>
									</div>
                                    <div class="text-center mt-1">
                                        Don't have an account? <a href="{{ route('register') }}">Register</a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{ asset('template/js/app.js') }}"></script>

</body>

</html>