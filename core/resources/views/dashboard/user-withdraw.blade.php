@extends('layouts.dashboard')
@section('style')
    <style>
        span.label{
            font-size: 12px; !important;
        }
        td,th{
            font-size: 14px;
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
            <th>Date</th>
            <th>Withdraw Number</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Send Details</th>
            <th>Message</th>
            <th>Success Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($withdraw as $p)
            @php $i++;@endphp

            <tr>
                <td>{{ $i }}</td>
                <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i:s A') }}</td>
                <td>{{ $p->withdraw_number }}</td>
                <td width="10%"><strong>{{ $p->amount }} - {{ $basic->currency }}</strong></td>
                <td><span class="aaaa">{{ $p->withdrawMethod->title }}</span></td>
                <td width="13%">{{ $p->details }}</td>
                <td>
                    @if($p->message == null)
                        <i>Null</i>
                    @else
                        {{ $p->message }}
                    @endif
                </td>
                <td>
                    @if($p->made_date == null)
                        <span class="label label-success"><i class="fa fa-times"></i> Not Seen Yet.</span>
                    @else
                        {{ \Carbon\Carbon::parse($p->made_date)->format('d F Y h:i:s A') }}
                    @endif
                </td>
                <td>
                    @if($p->status == 0)
                        <span class="label label-secondary"><i class="fa fa-spinner"></i> Pending</span>
                    @elseif($p->status == 1)
                        <span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Completed</span>
                    @else
                        <span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Refunded</span>
                    @endif

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