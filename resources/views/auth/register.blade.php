<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="AdminKit">
	<link rel="shortcut icon" href="{{ asset('template/img/icons/icon-48x48.png') }}" />

	<title>Sign Up | DP Center</title>

	<link href="{{ asset('template/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

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
                                        <h1 class="h2">Register</h1>
                                        <p class="lead">
                                            Please create your account before Login.
                                        </p>
                                    </div>
                                    <hr>
									<form method="POST" action="{{ route('register') }}">
                                    @csrf
                                        <div class="mb-3">
											<label class="form-label">Full name</label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label">Mobile Phone Number</label>
											<div class="input-group mb-2">
												<div class="input-group-prepend">
												<div class="input-group-text">MY +60</div>
												</div>
												<input type="text" name="mobile_phone_number" value="{{ old('mobile_phone_number') }}" class="form-control @error('mobile_phone_number') is-invalid @enderror" placeholder="Enter your mobile phone number">
												@error('mobile_phone_number')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter password" />
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
                                        <div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control" type="password" name="password_confirmation" placeholder="Enter confirm password" />
										</div>
										<div class="mb-3">
											<label class="form-label">Role</label>
											<select class="form-control @error('role') is-invalid @enderror" name="role">
												<option value="">Select your role</option>
												<option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
												<option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
											</select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Register now</button>
										</div>
									</form>
                                    <div class="text-center mt-3">
                                        Already have account? <a href="{{ route('login') }}">Login</a>
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