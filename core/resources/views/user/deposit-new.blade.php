@extends('layouts.user')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-send"></i> <strong>{{ $page_title }}</strong></div>

                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <div class="row">
                        @foreach($plan as $p)

                            <div class="col-sm-4 text-center">
                                <div class="panel panel-info panel-pricing">
                                    <div class="panel-heading">
                                        <h3 style="font-size: 28px;"><b>{{ $p->name }}</b></h3>
                                    </div>
                                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                        <p><strong>{{ $p->minimum }} {{ $basic->currency }} - {{ $p->maximum }} {{ $basic->currency }}</strong></p>
                                    </div>
                                    <ul style='font-size: 15px;' class="list-group text-center bold">
                                        <li class="list-group-item"><i class="fa fa-check"></i> Commission - {{ $p->percent }} <i class="fa fa-percent"></i> </li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Time - {{ $p->time }} times </li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Compound - <span class="aaaa">{{ $p->compound->name }}</span></li>
                                    </ul>
                                    <div class="panel-footer" style="overflow: hidden">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-info btn-block btn-icon icon-left delete_button"
                                                    data-toggle="modal" data-target="#DelModal"
                                                    data-id="{{ $p->id }}">
                                                <i class="fa fa-send"></i> Invest Under This Package
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div><!---ROW-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-money"></i> Add Found via Credit Card</h4>
                </div>
                {!! Form::open() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-2 col-sm-offset-2 control-label">Amount : </label>

                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" value="" name="amount" class="form-control" required>
                                        <span class="input-group-addon">&nbsp;<strong>USD</strong></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Add Fund</button>
                </div>
                {!! Form::close() !!}
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
                    <strong>Are you sure you want to Invest this Package.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('deposit-post') }}" class="form-inline">
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

@endsection

