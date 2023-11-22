@extends('layouts.app')

@push('title') DP Center | Track & Trace @endpush

@push('style')
    <style>
        .dataTables_filter {
            margin-bottom: .5rem !important;
        }

        table {
            margin-bottom: .5rem !important;
        }
    </style>
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Track & Trace</li>
@endpush

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Track & Trace</h3>
                            <div>   
                                <table id="customers" class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="30%">Parcel Number</th>
                                            <th width="30%">Courier Name</th>
                                            <th width="20%">Date</th>
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
                    {data: 'date_my', name: 'date_my'}
                ]
            });

        })
    </script>
@endpush