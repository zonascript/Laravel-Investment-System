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
                        <div class="col-md-4">
                            <div class="col-sm-12 text-center">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 style="font-size: 28px;"><b>
                                                @if($payment_type == 1)
                                                    Paypal
                                                @elseif($payment_type == 2)
                                                    Perfect Money
                                                @elseif($payment_type == 3)
                                                    BTC - ( BlockChain )
                                                @else
                                                    Credit Card
                                                @endif
                                            </b></h3>
                                    </div>
                                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                        @if($payment_type == 1)
                                            @php $img = $payment->paypal_image @endphp
                                        @elseif($payment_type == 2)
                                            @php $img = $payment->perfect_image @endphp
                                        @elseif($payment_type == 3)
                                            @php $img = $payment->btc_image @endphp
                                        @else
                                            @php $img = $payment->stripe_image @endphp
                                        @endif
                                        <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $img }}" alt="">
                                    </div>
                                    <hr>
                                    <div class="panel-footer">
                                        <a href="{{ url('user/fund-add') }}" class="btn btn-info btn-block btn-icon icon-left"><i
                                                    class="fa fa-arrow-left"></i> Back to Payment Method Page</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-info panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>
                                </div>
                                <!-- panel body -->
                                <div class="panel-body">
                                    <div class="text-center">
                                        <h3>Current Balance : <strong>{{ Auth::user()->amount }} - {{ $basic->currency }}</strong></h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-2 text-right control-label">Amount : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ $amount }}" readonly name="amount" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> USD </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-12 col-md-8 col-md-offset-2">


                                            <!-- CREDIT CARD FORM STARTS HERE -->
                                            <div class="panel panel-default credit-card-box">
                                                <div class="panel-body">
                                                    <form role="form" id="payment-form" method="POST" action="{{ route('stripe-submit') }}">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                                        <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
                                                        <input type="hidden" name="charge" value="{{ $charge }}">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="cardNumber">CARD NUMBER</label>
                                                                    <div class="input-group">
                                                                        <input
                                                                                type="tel"
                                                                                class="form-control input-lg"
                                                                                name="cardNumber"
                                                                                placeholder="Valid Card Number"
                                                                                autocomplete="off"
                                                                                required autofocus
                                                                        />
                                                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="row">
                                                            <div class="col-xs-4 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="cardExpiry"><span class="hidden-xs">MONTH</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                                                    <input
                                                                            type="tel"
                                                                            class="form-control input-lg"
                                                                            name="cardExpiryMonth"
                                                                            placeholder="MM"
                                                                            autocomplete="off"
                                                                            required
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="cardExpiry"><span class="hidden-xs">YEAR</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                                                    <input
                                                                            type="tel"
                                                                            class="form-control input-lg"
                                                                            name="cardExpiryYear"
                                                                            placeholder="YYYY"
                                                                            autocomplete="off"
                                                                            required
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4 col-md-4 pull-right">
                                                                <div class="form-group">
                                                                    <label for="cardCVC">CV CODE</label>
                                                                    <input
                                                                            type="tel"
                                                                            class="form-control input-lg"
                                                                            name="cardCVC"
                                                                            placeholder="CVC"
                                                                            autocomplete="off"
                                                                            required
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <br>

                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <button class="btn btn-success btn-lg btn-block" type="submit"> PAY NOW </button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <!-- CREDIT CARD FORM ENDS HERE -->
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!---ROW-->

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Deposit this Package.?</strong>
                </div>

                {{--<div class="modal-footer">
                    <form method="post" action="{{ route('deposit-submit') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>--}}

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

