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
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">List of Parcel</h3>
                            <div>
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                @if ($message = Session::get('danger'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <a href="{{ route('staff.parcel.create', $user) }}" class="btn btn-xs btn-success mb-2">
                                    Add
                                </a>
                                <table id="customers" class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="30%">Parcel Number</th>
                                            <th width="30%">Courier Name</th>
                                            <th width="20%">Date</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $.noConflict();
            
            var table = $('#customers').DataTable({
                ajax: '',
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'parcel_no', name: 'parcel_no'},
                    {data: 'courier', name: 'courier'},
                    {data: 'date_my', name: 'date_my'},
                    {data: 'action', name: 'action'},
                ]
            });

        })
    </script>
@endpush