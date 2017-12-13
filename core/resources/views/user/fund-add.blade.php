@extends('layouts.user')
@section('style')

    <script type="text/javascript" src="{{ asset('assets/dashboard/js/nicEdit.js') }}">

    </script>
    <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        //]]>
    </script>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>

                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <div class="row">
                        @if($payment->paypal_status == 1)
                        <div class="col-md-3">
                            <div class="panel panel-info" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-paypal"></i> <strong>{{ $payment->paypal_name }}</strong></div>

                                </div>
                                <!-- panel body -->
                                <div class="panel-body">
                                    <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $payment->paypal_image }}" alt="">
                                </div>
                                <div class="panel-footer">
                                    <a href="javascript:;" onclick="jQuery('#modal-1').modal('show');" class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> ADD FOUND</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($payment->perfect_status == 1)
                        <div class="col-md-3">
                            <div class="panel panel-danger" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-cc-mastercard"></i> <strong>{{ $payment->perfect_name }}</strong></div>
                                </div>
                                <!-- panel body -->
                                <div class="panel-body">
                                    <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $payment->perfect_image }}" alt="">
                                </div>
                                <div class="panel-footer">
                                    <a href="javascript:;" onclick="jQuery('#modal-2').modal('show');" class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> ADD FOUND</a>
                                </div>
                            </div>
                        </div>
                        @endif
                            @if($payment->btc_status == 1)
                        <div class="col-md-3">
                            <div class="panel panel-info" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-btc"></i> <strong>{{ $payment->btc_name }}</strong></div>

                                </div>
                                <!-- panel body -->
                                <div class="panel-body">
                                    <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $payment->btc_image }}" alt="">
                                </div>
                                <div class="panel-footer">
                                    <a href="javascript:;" onclick="jQuery('#modal-3').modal('show');" class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> ADD FOUND</a>
                                </div>
                            </div>
                        </div>
                            @endif
                            @if($payment->stripe_status == 1)
                        <div class="col-md-3">
                            <div class="panel panel-danger" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-cc-stripe"></i> <strong>{{ $payment->stripe_name }}</strong></div>

                                </div>
                                <!-- panel body -->
                                <div class="panel-body">
                                    <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $payment->stripe_image }}" alt="">
                                </div>
                                <div class="panel-footer">
                                    <a href="javascript:;" onclick="jQuery('#modal-4').modal('show');" class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> ADD FOUND</a>
                                </div>
                            </div>
                        </div>
                            @endif
                    </div>
                </div>

            </div>
        </div>
    </div><!---ROW-->
    <!-- Modal 1 (Basic)-->
    <div class="modal fade" id="modal-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-money"></i> Add Found via Paypal</h4>
                </div>
                {{ Form::open() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="margin-top: 20px;font-size: 14px;" class="col-sm-2 col-sm-offset-2 control-label">Amount : </label>
                                <div class="col-sm-7">
                                    <span style="color: green;margin-left: 10px;"><strong>{{ $payment->paypal_min }} - {{ $payment->paypal_max }} {{ $basic->currency }}. Charge ({{ $payment->paypal_fix }} + {{ $payment->paypal_percent }}) {{ $basic->currency }}</strong></span>
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <input type="text" value="" id="amount" name="amount" class="form-control" required />
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                        <input type="hidden" name="payment_type" id="payment_type" value="1">
                                        <input type="hidden" name="rate" value="{{ $payment->paypal_rate }}">
                                        <input type="hidden" name="fix" value="{{ $payment->paypal_fix }}">
                                        <input type="hidden" name="percent" value="{{ $payment->paypal_percent }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="result"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-2">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-money"></i> Add Found via Perfect Money</h4>
                </div>
                {{ Form::open() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="margin-top: 20px;font-size: 14px;" class="col-sm-2 col-sm-offset-2 control-label">Amount : </label>
                                <div class="col-sm-7">
                                    <span style="color: green;margin-left: 10px;"><strong>{{ $payment->perfect_min }} - {{ $payment->perfect_max }} {{ $basic->currency }}. Charge ({{ $payment->perfect_fix }} + {{ $payment->perfect_percent }}) {{ $basic->currency }}</strong></span>
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <input type="text" value="" id="amount2" name="amount" class="form-control" required>
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                        <input type="hidden" name="payment_type" id="payment_type2" value="2">
                                        <input type="hidden" name="rate" value="{{ $payment->perfect_rate }}">
                                        <input type="hidden" name="fix" value="{{ $payment->perfect_fix }}">
                                        <input type="hidden" name="percent" value="{{ $payment->perfect_percent }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="result2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-3">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-money"></i> Add Found via BlockChain (BTC)</h4>
                </div>
                {{ Form::open() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="margin-top: 20px;font-size: 14px;" class="col-sm-2 col-sm-offset-2 control-label">Amount : </label>
                                <div class="col-sm-7">
                                    <span style="color: green;margin-left: 10px;"><strong>{{ $payment->btc_min }} - {{ $payment->btc_max }} {{ $basic->currency }} Charge ({{ $payment->btc_fix }} + {{ $payment->btc_percent }}) {{ $basic->currency }}</strong></span>
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <input type="text" value="" id="amount3" name="amount" class="form-control" required>
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                        <input type="hidden" name="payment_type" id="payment_type3" value="3">
                                        <input type="hidden" name="rate" value="{{ $payment->btc_rate }}">
                                        <input type="hidden" name="fix" value="{{ $payment->btc_fix }}">
                                        <input type="hidden" name="percent" value="{{ $payment->btc_percent }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="result3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-money"></i> Add Found via Credit Card</h4>
                </div>
                {{ Form::open() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="margin-top: 20px;font-size: 14px;" class="col-sm-2 col-sm-offset-2 control-label">Amount : </label>
                                <div class="col-sm-7">
                                    <span style="color: green;margin-left: 10px;"><strong>{{ $payment->stripe_min }} - {{ $payment->stripe_max }} {{ $basic->currency }}. Charge ({{ $payment->stripe_fix }} + {{ $payment->stripe_percent }}) {{ $basic->currency }}</strong></span>
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <input type="text" value="" id="amount4" name="amount" class="form-control" required>
                                        <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                        <input type="hidden" name="payment_type" id="payment_type4" value="4">
                                        <input type="hidden" name="rate" value="{{ $payment->stripe_rate }}">
                                        <input type="hidden" name="fix" value="{{ $payment->stripe_fix }}">
                                        <input type="hidden" name="percent" value="{{ $payment->stripe_percent }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="result4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script type='text/javascript'>

        jQuery(document).ready(function(){

            $('#amount').on('input', function() {
                var amount = $("#amount").val();
                var payment_type = $("#payment_type").val();
                $.post(
                        '{{ url('/paypal-check-amount') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            amount : amount,
                            payment_type : payment_type
                        },
                        function(data) {
                            $("#result").html(data);
                        }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function(){

            $('#amount2').on('input', function() {
                var amount = $("#amount2").val();
                var payment_type = $("#payment_type2").val();
                $.post(
                        '{{ url('/paypal-check-amount') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            amount : amount,
                            payment_type : payment_type
                        },
                        function(data) {
                            $("#result2").html(data);
                        }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function(){

            $('#amount3').on('input', function() {
                var amount = $("#amount3").val();
                var payment_type = $("#payment_type3").val();
                $.post(
                        '{{ url('/paypal-check-amount') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            amount : amount,
                            payment_type : payment_type
                        },
                        function(data) {
                            $("#result3").html(data);
                        }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function(){

            $('#amount4').on('input', function() {
                var amount = $("#amount4").val();
                var payment_type = $("#payment_type4").val();
                $.post(
                        '{{ url('/paypal-check-amount') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            amount : amount,
                            payment_type : payment_type
                        },
                        function(data) {
                            $("#result4").html(data);
                        }
                );
            });
        });
    </script>

@endsection

