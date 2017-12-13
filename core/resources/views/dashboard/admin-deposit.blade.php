@extends('layouts.dashboard')
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
            <th>Date Time</th>
            <th>Deposit ID</th>
            <th>Depositor Details</th>
            <th>Deposit Plan</th>
            <th>Deposit Amount</th>
            <th>Percent</th>
            <th>Rebeat Time</th>
            <th>Rebeat Compound</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($deposit as $p)
            @php $i++;@endphp
            <tr>
                <td>{{ $i }}</td>
                <td width="10%">{{ date('d-F-Y h:s:i A',strtotime($p->created_at)) }}</td>
                <td></td>
                <td width="15%">{{ $p->user->name }}<br>{{ $p->user->email }}</td>
                <td><span class="aaaa"><strong>{{ $p->plan->name }}</strong></span></td>
                <td>{{ $p->amount }} - {{ $basic->currency }}</td>
                <td width="8%">{{ $p->percent }} %</td>
                <td>{{ $p->time }} - times</td>
                <td><span class="aaaa"><strong>{{ $p->compound->name }}</strong></span></td>
                <td>
                    @if($p->status == 0)
                        <span class="label label-secondary"><i class="fa fa-spinner"></i> Running</span>
                    @else
                        <span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Completed</span>
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