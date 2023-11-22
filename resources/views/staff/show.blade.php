@extends('layouts.app')

@push('title') DP Center | View Staff @endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">List of Staff</a></li>
	<li class="breadcrumb-item active" aria-current="page">View Staff</li>
@endpush

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="border rounded">
                                <div class="row m-2">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Staff Details</h3>
                                        <h6 class="card-subtitle text-muted">Access detailed information on staff.</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="input-title">Name</label>
                                            <h6 class="input-show">{{ $user->name }}</h6>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="input-title">Email</label>
                                            <h6 class="input-show">{{ $user->email }}</h6>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Phone Number</label>
                                            <h6 class="input-show">{{ $user->phone_number_my }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection