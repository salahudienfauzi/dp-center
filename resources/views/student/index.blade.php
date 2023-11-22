@extends('layouts.app')

@push('title') DP Center | List of Student @endpush

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
	<li class="breadcrumb-item active" aria-current="page">List of Student</li>
@endpush

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">List of Student</h3>
                            <div>   
                                <table id="customers" class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="30%">Name</th>
                                            <th width="30%">Email</th>
                                            <th width="20%">Phone</th>
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
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number_my', name: 'phone_number_my'},
                    {data: 'action', name: 'action'},
                ]
            });

        })
    </script>
@endpush