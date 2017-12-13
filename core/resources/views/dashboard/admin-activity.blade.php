@extends('layouts.dashboard')
@section('style')
    <style>
        span.label{
            font-size: 12px; !important;
        }
        th,td{
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
            <th>Balance Type</th>
            <th>Balance</th>
            <th>Charge</th>
            <th>Balance Details</th>
            <th>Past Balance</th>
            <th>Present Balance</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($activity as $p)
            @php $i++;@endphp
            <tr>
                <td>{{ $i }}</td>
                <td width="18%">{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A') }}</td>
                <td width="11%">
                    @if($p->balance_type == 1)
                        <span class="label label-info"><i class="fa fa-plus"></i> Add Fund</span>
                    @elseif($p->balance_type == 2)
                        <span class="label label-success"><i class="fa fa-cloud-download"></i> Deposit</span>
                    @elseif($p->balance_type == 3)
                        <span class="label label-success"><i class="fa fa-recycle"></i> Rebeat</span>
                    @elseif($p->balance_type == 4)
                        <span class="label label-success"><i class="fa fa-reply-all"></i> Withdraw</span>
                    @elseif($p->balance_type == 5)
                        <span class="label label-success"><i class="fa fa-user-circle-o"></i> Referral</span>
                    @elseif($p->balance_type == 7)
                        <span class="label label-danger"><i class="fa fa-bolt"></i> Refund</span>
                    @elseif($p->balance_type == 6)
                        <span class="label label-danger"><i class="fa fa-check"></i> Completed</span>
                    @elseif($p->balance_type == 8)
                        <span class="label label-success"><i class="fa fa-plus"></i> Bank</span>
                    @endif
                </td>
                <td width="10%">{{ $p->balance }} - {{ $basic->currency }}</td>
                <td width="9%">
                    @if($p->charge == null)
                        <i>Null</i>
                    @else
                        {{ $p->charge }} - {{ $basic->currency }}
                    @endif
                </td>
                <td>{{ $p->details }}</td>
                <td width="12%">{{ round($p->old_balance,3) }} - {{ $basic->currency }}</td>
                <td width="12%">{{ round($p->new_balance,3) }} - {{ $basic->currency }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
@section('scripts')


    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection