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



    <div class="col-md-12">
        <div class="panel panel-info panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-money"></i> <strong>Add Growth Percentage </strong></div>
            </div>
            <!-- panel body -->
            <div class="panel-body">
                <div class="text-center">
               <h3>Growth Percentage : <strong> % </strong></h3>
                </div>
                <hr>
                {!! Form::open(['route'=>'submit-growth']) !!}
                <div class="row">
                    <div class="form-group">
                        <label style="margin-top: 5px;font-size: 14px;" class="col-md-2 col-sm-offset-2 text-right control-label">Growth : </label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="growth" id="growth" class="form-control" placeholder="Enter Growth Percentage" required>
                                <span class="input-group-addon red">&nbsp;<strong> %  </strong></span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">

                        <div class=" col-sm-offset-4 col-sm-6">
                            <button id="submt" class="btn btn-success btn-icon icon-left btn-block"><i class="fa fa-send"></i> Submit</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <hr>
            </div>
        </div>
    </div>
@endsection
@section('scripts')


    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready( function() {
            $("h2").text("Growth Percentage");
        });
    </script>
@endsection