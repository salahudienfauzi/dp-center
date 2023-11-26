@extends('layouts.app')

@push('title') DP Center | Add Parcel @endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Profile</li>
@endpush

@section('content')
    <main class="content">
        <form method="POST" action="{{ route('profile.post') }}">
        @csrf
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="border rounded">
                                    <div class="row m-2">
                                        <div class="col-md-4">
                                            <h3 class="card-title">Personal Information</h3>
                                            <h6 class="card-subtitle text-muted">Edit your personal information.</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="input-title">Profile Name</label>
                                                <input type="text" name="profile_name" value="{{ old('profile_name') ?? auth()->user()->name }}" class="form-control @error('profile_name') is-invalid @enderror">
                                                @error('profile_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="input-title">Phone Number</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">MY +60</div>
                                                    </div>
                                                    <input type="text" name="mobile_phone_number" value="{{ old('mobile_phone_number') ?? auth()->user()->phone }}" class="form-control @error('mobile_phone_number') is-invalid @enderror">
                                                    @error('mobile_phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Email</label>
                                                <input type="string" name="email" value="{{ old('email') ?? auth()->user()->email }}" class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-xs btn-primary mt-3">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection