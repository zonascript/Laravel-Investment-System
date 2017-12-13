@extends('layouts.user')
@section('style')
    <style>
        span.label{
            font-size: 12px; !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">
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
            <th>Amount </th>
            <th>Deposit ID </th>
            <th>Plan Name</th>
            <th>Compound</th>
            <th>Made Time</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($repeat as $p)
            @php $i++;@endphp
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $p->balance }} - {{ $basic->currency }}</td>
                <td>{{ $p->deposit->deposit_number }}</td>
                <td><span class="aaaa">{{ $p->deposit->plan->name }}</span></td>
                <td>
                    <strong><span class="aaaa">{{ $p->deposit->compound->name }}</span></strong>
                </td>
                <td><strong>{{ \Carbon\Carbon::parse($p->made_time) }}</strong></td>
                <td>
                    <span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Complete</span>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection
@section('scripts')


    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection