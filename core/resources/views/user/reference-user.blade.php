@extends('layouts.user')
@section('style')
    <style>
        span.label{
            font-size: 12px; !important;
        }
        th,td{
            font-size: 15px;
        }
    </style>
@endsection
@section('content')

    <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            var $table4 = jQuery( "#table-4" );

            $table4.DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );
    </script>

    <table class="table table-striped table-hover table-bordered datatable" id="table-4">
        <thead>
        <tr>
            <th>No</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Reference ID</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($user as $p)
            @php $i++;@endphp
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->reference }}</td>
                <td>{{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
@section('scripts')


    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection