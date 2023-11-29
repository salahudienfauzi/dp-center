@extends('layouts.app')

@push('title') DP Center | Receipt @endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payment.index') }}">List of Payment</a></li>
	<li class="breadcrumb-item active" aria-current="page">Receipt</li>
@endpush

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mx-auto">
                <div class="col-6 offset-md-3">
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">
                            <h5 class="mb-0">Receipt</h5>
                        </div>
                        <div class="card-body text-center">
                            <p><strong>Parcel Number:</strong> {{ $parcel->parcel_no }}</p>
                            <p><strong>Courier Name:</strong> {{ $parcel->courier }}</p>
                            <p><strong>Date:</strong> {{ $parcel->date->format('d-m-Y') }}</p>
                            <hr>
                            <p class="text-right"><strong>Total Amount:</strong> RM{{ $parcel->payment->price }}</p>
                            <p class="text-right"><strong>Payment Method:</strong> {{ $parcel->payment->type == 2 ? 'Transfer' : 'Cash' }}</p>
                            <p class="text-right"><strong>Pick Up Method:</strong> {{ $parcel->payment->pick_up == 2 ? 'Delivery' : 'Self pick up' }}</p>
                        </div>
                        <div class="card-footer text-muted text-center">
                            Thank you for your purchase!<br>
                            <a href="{{ route('payment.index') }}" class="btn btn-secondary mt-3">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection