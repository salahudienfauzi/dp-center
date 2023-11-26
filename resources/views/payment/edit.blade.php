@extends('layouts.app')

@push('title') DP Center | Transaction @endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payment.index') }}">List of Payment</a></li>
	<li class="breadcrumb-item active" aria-current="page">Transactions</li>
@endpush

@section('content')
    <main class="content">
        <form method="POST" action="{{ route('payment.update', $parcel) }}" enctype="multipart/form-data">
        @csrf
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="border rounded">
                                    <div class="row m-2">
                                        <div class="col-md-4">
                                            <h3 class="card-title">Transactions</h3>
                                            <h6 class="card-subtitle text-muted">Add transactions for your to pickup.</h6>
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
                                                <select name="payment_option" class="form-control @error('payment_option') is-invalid @enderror">
                                                    <option value="">Select payment option</option>
                                                    <option value="cash" {{ old('payment_option') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="transfer" {{ old('payment_option') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                                </select>
                                                @error('payment_option')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="input-title">Pick Up Option</label>
                                                <select name="pick_up_option" class="form-control @error('pick_up_option') is-invalid @enderror">
                                                    <option value="">Select pick up option</option>
                                                    <option value="1" {{ old('pick_up_option') == 1 ? 'selected' : '' }}>Self pick up</option>
                                                    <option value="2" {{ old('pick_up_option') == 2 ? 'selected' : '' }}>Delivery</option>
                                                </select>
                                                @error('pick_up_option')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="input-title">Upload Receipt</label>
                                                <input type="file" name="receipt" class="form-control @error('receipt') is-invalid @enderror">
                                                @error('receipt')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-xs btn-success mt-3">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection