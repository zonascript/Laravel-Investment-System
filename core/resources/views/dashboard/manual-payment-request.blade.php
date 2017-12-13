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
            <th>Transaction ID</th>
            <th>Method Name</th>
            <th>Total</th>
            <th>Charge</th>
            <th>Amount</th>
            <th>Success Date</th>
            <th>Status</th>
            <th>Documentation</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($fund as $p)
            @php $i++;@endphp

            <tr>
                <td>{{ $i }}</td>
                <td width="13%">{{ \Carbon\Carbon::parse($p->created_at)->format('d-F-y h:i:s A') }}</td>
                <td>{{ $p->log->transaction_id }}</td>
                <td width="12%">{{ $p->log->method->name }}</td>
                <td width="15%">{{ $basic->symbol }} {{ $p->log->total }}</td>
                <td>{{ $basic->symbol }} {{ $p->log->charge }}</td>
                <td>{{ $basic->symbol }} {{ $p->log->amount }}</td>
                <td width="10%">
                    @if($p->made_time == null)
                        <span class="label label-success"><i class="fa fa-times"></i> Not Seen Yet.</span>
                    @else
                        {{ \Carbon\Carbon::parse($p->made_time)->format('d-F-y h:i:s A') }}
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
                <td>
                    <a target="_blank" href="{{ route('manual-payment-view',$p->id) }}" class="btn btn-info btn-sm btn-icon icon-left"><i class="fa fa-eye"></i>View</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
@section('scripts')

    <script>
        $(document).ready(function(){

            $(document).on('click', '#getUser', function(e){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                e.preventDefault();

                var uid = $(this).data('id'); // get id of clicked row

                $('#dynamic-content').html(''); // leave this div blank
                $('#modal-loader').show();      // load ajax loader on button click

                $.ajax({
                    url: '{{ url('/user/manual-fund-details') }}',
                    type: 'POST',
                    data: 'id='+uid,
                    dataType: 'html'
                })
                        .done(function(data){
                            console.log(data);
                            $('#dynamic-content').html(''); // blank before load.
                            $('#dynamic-content').html(data); // load here
                            $('#modal-loader').hide(); // hide loader
                        })
                        .fail(function(){
                            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#modal-loader').hide();
                        });

            });
        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">
    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection