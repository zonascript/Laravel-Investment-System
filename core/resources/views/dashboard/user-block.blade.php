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
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap-popover-x.min.css') }}">
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
            <th>Name</th>
            <th>Email</th>
            <th>Current Amount</th>
            <th>Block At</th>
            <th>Documentation</th>
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
                <td>{{ $p->amount }} - {{ $basic->currency }}</td>
                <td>{{ \Carbon\Carbon::parse($p->block_at)->format('d F Y H:i A') }}</td>
                <td width="30%">
                    <button data-toggle="modal" data-target="#view-modal"
                            data-id="{{ $p->id }}"
                            id="getUser" class="btn btn-info btn-icon icon-left">
                        <i class="fa fa-eye"></i> Details
                    </button>
                    <button type="button" class="btn btn-primary btn-icon icon-left" data-toggle="popover-x" data-target="#myPopover{{ $p->id }}" data-placement="top"><i class="fa fa-list"></i> Activity</button>

                    <div id="myPopover{{ $p->id }}" class="popover popover-success popover-md">
                        <div class="arrow"></div>
                        <div class="popover-title"><span class="close" data-dismiss="popover-x">&times;</span><strong><i class="fa fa-indent"></i> Activity</strong></div>
                        <div class="popover-content">
                            <a href="{{ route('user-transaction',$p->id) }}" class="btn btn-info btn-icon icon-left"><i class="fa fa-cloud-upload"></i> Transaction</a>
                            <a href="{{ route('user-deposit',$p->id) }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-cloud-download"></i> Deposit</a>
                            <a href="{{ route('user-withdraw',$p->id) }}" class="btn btn-danger btn-icon icon-left"><i class="fa fa-reply-all"></i> Withdraw</a>
                        </div>
                    </div>
                    @if($p->block_status == 1)
                        <button type="button" class="btn btn-danger btn-icon icon-left unblock_button"
                                data-toggle="modal" data-target="#unblocklModal"
                                data-id="{{ $p->id }}">
                            <i class="fa fa-user-plus"></i> UnBlock
                        </button>
                    @else
                        <button type="button" class="btn btn-danger btn-icon icon-left block_button"
                                data-toggle="modal" data-target="#blockModal"
                                data-id="{{ $p->id }}">
                            <i class="fa fa-user-times"></i> Block
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <meta name="_token" content="{!! csrf_token() !!}" />

    <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">

                    <strong>Are you sure you want to <strong>Block</strong> This User.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('user-block') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="unblocklModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">

                    <strong>Are you sure you want to <strong>UnBlock</strong> This User.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('user-unblock') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">
                        <i class="glyphicon glyphicon-user"></i> User Details
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
                    url: '{{ url('/user-details') }}',
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

            $(document).on("click", '.block_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>
    <script>
        $(document).ready(function () {

            $(document).on("click", '.unblock_button', function (e) {
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

    <script src="{{ asset('assets/dashboard/js/bootstrap-popover-x.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection