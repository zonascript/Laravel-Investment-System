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
                <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-2 col-sm-offset-2 control-label">Amount : </label>
                                    <div class="col-sm-7">
                                        <div class="input-group" style="margin-bottom: 15px;">
                                            <input type="text" value="" id="amount" name="amount" class="form-control" required>
                                            <span class="input-group-addon">&nbsp;<strong>USD</strong></span>
                                            <input type="hidden" name="payment_type" id="payment_type" value="1">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="cmd" value="_xclick" />
                                <input type="hidden" name="business" value="{{ $payment->paypal_email }}" />
                                <input type="hidden" name="cbt" value="{{ $site_title }}" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <input type="hidden" name="quantity" value="1" />
                                <input type="hidden" name="item_name" value="Add Funding" />

                                <!-- Custom value you want to send and process back in the IPN -->
                                <input type="hidden" name="custom" value="{{ $mmm->code }}" />

                                {{--<input name="amount" type="hidden" value="{{ $mmm->price }}">--}}
                                <input type="hidden" name="return" value="{{ route('add-fund') }}"/>
                                <input type="hidden" name="cancel_return" value="{{ route('add-fund') }}" />
                                <!-- Where to send the PayPal IPN to. -->
                                <input type="hidden" name="notify_url" value="{{ route('paypal-ipn') }}" />

                                <div class="form-group">
                                    <div id="result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    <div class="modal fade" id="modal-3">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-money"></i> Add Found via BlockChain (BTC)</h4>
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

@endsection

