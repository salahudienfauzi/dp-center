@extends('layouts.app')

@push('title') DP Center | Add Parcel @endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">List of Student</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.show', $user) }}">View Student</a></li>
	<li class="breadcrumb-item active" aria-current="page">Add Parcel</li>
@endpush

@section('content')
    <main class="content">
        <form method="POST" action="{{ route('student.parcel.store', $user) }}">
        @csrf
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="border rounded">
                                    <div class="row m-2">
                                        <div class="col-md-4">
                                            <h3 class="card-title">Add Parcel</h3>
                                            <h6 class="card-subtitle text-muted">Add parcel for student to pickup.</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="input-title">Parcel No.</label>
                                                <input type="text" name="parcel_no" value="{{ old('parcel_no') }}" class="form-control @error('parcel_no') is-invalid @enderror">
                                                @error('parcel_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="input-title">Courier Name</label>
                                                <input type="text" name="courier_name" value="{{ old('courier_name') }}" class="form-control @error('courier_name') is-invalid @enderror">
                                                @error('courier_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Date</label>
                                                <input type="date" name="date" value="{{ old('date') }}" class="form-control @error('date') is-invalid @enderror">
                                                @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-xs btn-success mt-3">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection