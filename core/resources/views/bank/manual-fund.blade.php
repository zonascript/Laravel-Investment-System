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
                    <div class="panel-title"><i class="fa fa-send"></i> <strong> Add Deposit via Bank</strong></div>

                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <div class="row">
                        @foreach($bank as $p)

                            <div class="col-sm-4 text-center">
                                <div class="panel panel-success panel-pricing">
                                    <div class="panel-heading">
                                        <h3 style="font-size: 28px;"><b>{{ $p->name }}</b></h3>
                                    </div>
                                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                        <p><strong>{{ $basic->symbol }}{{ $p->minimum }} - Unlimited</strong></p>
                                    </div>

                                    <div class="panel-footer" style="overflow: hidden">
                                        <div class="col-sm-12">
                                            <a href="javascript:;" onclick="jQuery('#modal-{{ $p->id }}').modal('show');" class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-send"></i> Add Fund</a>
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
    @foreach($bank as $p)
        <div class="modal fade" id="modal-{{ $p->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-send"></i> Deposit via <strong>{{ $p->name }}</strong></h4>
                    </div>
                    {{ Form::open() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-2 col-sm-offset-2 control-label">Amount : </label>
                                    <div class="col-sm-7">
                                        <span style="color: green;margin-left: 10px;"><strong>{{ $basic->symbol }} {{ $p->minimum}} - Unlimited. </strong></span>
                                        <div class="input-group" style="margin-bottom: 15px;">
                                            <input type="text" value="" id="amount{{ $p->id }}" name="amount" class="form-control" required>
                                            <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                            <input type="hidden" name="method_id" id="method_id{{ $p->id }}" value="{{ $p->id }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div id="result{{ $p->id }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endforeach


@endsection
@section('scripts')
    @foreach($bank as $p)
        <script type='text/javascript'>

            jQuery(document).ready(function(){

                $('#amount{{ $p->id }}').on('input', function() {
                    var amount = $("#amount{{ $p->id }}").val();
                    var method_id = $("#method_id{{ $p->id }}").val();
                    $.post(
                            '{{ url('/fund-check-amount') }}',
                            {
                                _token: '{{ csrf_token() }}',
                                amount : amount,
                                method_id : method_id
                            },
                            function(data) {
                                $("#result{{ $p->id }}").html(data);
                            }
                    );
                });
            });
        </script>
    @endforeach
@endsection

