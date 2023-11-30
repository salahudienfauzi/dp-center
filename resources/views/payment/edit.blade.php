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
                                @if ($message = Session::get('danger'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
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
                                                <select name="payment_option" id="payment_option" class="form-control @error('payment_option') is-invalid @enderror" onchange="myFunction()">
                                                    <option value="">Select payment option</option>
                                                    <option value="1" {{ old('payment_option') == 1 ? 'selected' : '' }}>Cash</option>
                                                    <option value="2" {{ old('payment_option') == 2 ? 'selected' : '' }}>Transfer</option>
                                                </select>
                                                @error('payment_option')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="input-title">Pick Up Option</label>
                                                <select name="pick_up_option" id="pick_up_option" class="form-control @error('pick_up_option') is-invalid @enderror" onchange="myFunction()">
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
                                                <label class="input-title">Total Payment</label>
                                                <h6 class="input-show" id="price-show"></h6>
                                                <input type="hidden" name="price" id="price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-xs btn-primary mt-3">
                                    Proceed to Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('script')
    <script>
    function myFunction() {
        var price = 1;
        var pick_up_option = document.getElementById("pick_up_option").value

        if (pick_up_option == 2) {
            price = price + 1
        }

        document.getElementById("price-show").innerHTML = 'RM' + price;
        document.getElementById("price").value = price;
    }
    </script>
@endpush