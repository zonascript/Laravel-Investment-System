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
            <th>Date Time</th>
            <th>Invest Plan</th>
            <th>Invest ID</th>
            <th>Invest Amount</th>
            <th>Invest Commission</th>
            <th>Repeat Time</th>
            <th>Repeat Compound</th>
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
                <td><span class="aaaa"><strong>{{ $p->plan->name }}</strong></span></td>
                <td>#{{ $p->deposit_number }}</td>
                <td>{{ $p->amount }} - {{ $basic->currency }}</td>
                <td width="13%">{{ $p->percent }} %</td>
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

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete this.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('delete-news') }}" class="form-inline">
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
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection