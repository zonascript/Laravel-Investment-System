@extends('layouts.user')
@section('style')
    <style>
        span.label{
            font-size: 12px; !important;
        }
        th,td{
            font-size: 14px;
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
            <th>Date</th>
            <th>Reference ID</th>
            <th>Bonus Details</th>
            <th>Bonus Amount</th>
            <th>Past Balance</th>
            <th>Present Balance</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($bonus as $p)
            @php $i++;@endphp
            <tr>
                <td>{{ $i }}</td>
                <td width="18%">{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A') }}</td>
                <td>{{ $p->under_reference }}</td>
                <td>{{ $p->details }}</td>
                <td>{{ $p->balance }} - {{ $basic->currency }}</td>
                <td>{{ $p->old_balance }} - {{ $basic->currency }}</td>
                <td>{{ $p->new_balance }} - {{ $basic->currency }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
@section('scripts')


    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection