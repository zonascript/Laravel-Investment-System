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
            <th>Method</th>
            <th>Amount</th>
            <th>Charge</th>
            <th>Total</th>
            <th>Status</th>
            <th>Documentation</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($withdraw as $p)
            @php $i++;@endphp

            <tr>
                <td>{{ $i }}</td>
                <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i:s A') }}</td>
                <td><span class="aaaa">{{ $p->withdrawMethod->title }}</span></td>
                <td><strong>{{ $p->amount }} - {{ $basic->currency }}</strong></td>
                <td><strong>{{ $p->charge }} - {{ $basic->currency }}</strong></td>
                <td><strong>{{ $p->total }} - {{ $basic->currency }}</strong></td>
                <td>
                    <button type="button" class="btn btn-info btn-icon icon-left delete_button"
                            data-toggle="modal" data-target="#DelModal"
                            data-id="{{ $p->id }}">
                        <i class="fa fa-send"></i> Payment
                    </button>
                    <button type="button" class="btn btn-danger btn-icon icon-left ref_button"
                            data-toggle="modal" data-target="#refModal"
                            data-id="{{ $p->id }}">
                        <i class="fa fa-exclamation-triangle"></i> Refund
                    </button>
                </td>
                <td>
                    <button data-toggle="modal" data-target="#view-modal"
                            data-id="{{ $p->id }}"
                            id="getUser" class="btn btn-sm btn-info btn-icon icon-left">
                        <i class="fa fa-eye"></i> Details
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <meta name="_token" content="{!! csrf_token() !!}" />

    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">
                        <i class="glyphicon glyphicon-user"></i> User Withdraw Details View
                    </h4>
                </div>

                <div class="modal-body">
                    <div id="modal-loader" style="display: none; text-align: center;">
                        <!-- ajax loader -->
                        <img src="{{ asset('assets/images/ajax-loader.gif') }}">
                    </div>

                    <!-- mysql data will be load here -->
                    <div id="dynamic-content"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to make Payment to this User?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('withdraw-success-submit') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="refModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Refund This User.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('withdraw-refund-submit') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


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
                    url: '{{ url('/withdraw-details') }}',
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

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>
    <script>
        $(document).ready(function () {

            $(document).on("click", '.ref_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>


    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection