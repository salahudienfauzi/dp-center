@extends('layouts.app')

@push('title') DP Center | Add Parcel @endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('history.index') }}">Histories</a></li>
	<li class="breadcrumb-item active" aria-current="page">Receipt</li>
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
                                    <div class="col-md-4">
                                        <h3 class="card-title">Receipt of Payment</h3>
                                        <h6 class="card-subtitle text-muted">Receipt of payment for parcel.</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="input-title">Parcel Number</label>
                                            <h6 class="input-show">{{ $parcel->parcel_no }}</h6>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="input-title">Courier Name</label>
                                            <h6 class="input-show">{{ $parcel->courier }}</h6>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="input-title">Date</label>
                                            <h6 class="input-show">{{ $parcel->date->format('d-m-Y') }}</h6>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="input-title">Payment Option</label>
                                            <h6 class="input-show">{{ $parcel->payment->type == 1 ? 'Cash' : 'Transfer' }}</h6>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="input-title">Pick Up Option</label>
                                            <h6 class="input-show">{{ $parcel->payment->pick_up == 1 ? 'Self pick up' : 'Delivery' }}</h6>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="input-title">Total Payment</label>
                                            <h6 class="input-show">RM{{ $parcel->payment->price }}</h6>
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