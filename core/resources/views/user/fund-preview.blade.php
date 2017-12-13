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
                                                @if($fund->payment_type == 1)
                                                    Paypal
                                                @elseif($fund->payment_type == 2)
                                                    Perfect Money
                                                @elseif($fund->payment_type == 3)
                                                    BTC - ( BlockChain )
                                                @else
                                                    Credit Card
                                                @endif
                                            </b></h3>
                                    </div>
                                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                        @if($fund->payment_type == 1)
                                            @php $img = $payment->paypal_image @endphp
                                        @elseif($fund->payment_type == 2)
                                            @php $img = $payment->perfect_image @endphp
                                        @elseif($fund->payment_type == 3)
                                            @php $img = $payment->btc_image @endphp
                                        @else
                                            @php $img = $payment->stripe_image @endphp
                                        @endif
                                        <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $img }}" alt="">
                                    </div>
                                    <hr>
                                    <div class="panel-footer">
                                        <a href="" class="btn btn-info btn-block btn-icon icon-left"><i
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
                                                    <input type="text" value="{{ $fund->amount }}" readonly name="amount" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-2 text-right control-label">Rate : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ $fund->rate }}" readonly name="rate" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-2 text-right control-label">Sub Total USD : </label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ round($fund->amount / $fund->rate , 3) }}" readonly name="rate" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> USD </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-2 text-right control-label">Charge : </label>
                                            <div class="col-sm-3">

                                                @if($fund->payment_type == 1)
                                                    @php $charge = $payment->paypal_fix + (($fund->amount * $payment->paypal_percent) / 100) @endphp
                                                @elseif($fund->payment_type == 2)
                                                    @php $charge = $payment->perfect_fix + ($fund->amount * $payment->perfect_percent / 100) @endphp
                                                @elseif($fund->payment_type == 3)
                                                    @php $charge = $payment->btc_fix + ($fund->amount * $payment->btc_percent / 100) @endphp
                                                @else
                                                    @php $charge = $payment->stripe_fix + ($fund->amount * $payment->stripe_percent / 100) @endphp
                                                @endif

                                                <div class="input-group">
                                                    <input type="text" value="{{ $charge }}" readonly name="rate" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-3 col-sm-offset-2 text-right control-label">Total USD : </label>
                                            <div class="col-sm-3">

                                                @if($fund->payment_type == 1)
                                                    @php $total = ($charge + $fund->amount) / $payment->paypal_rate @endphp
                                                @elseif($fund->payment_type == 2)
                                                    @php $total = ($charge + $fund->amount) / $payment->perfect_rate @endphp
                                                @elseif($fund->payment_type == 3)
                                                    @php $total = ($charge + $fund->amount) / $payment->btc_rate @endphp
                                                @else
                                                    @php $total = ($charge + $fund->amount) / $payment->stripe_rate @endphp
                                                @endif

                                                <div class="input-group">
                                                    <input type="text" value="{{ round(($total),3) }}" readonly name="rate" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> USD </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @if($fund->payment_type == 1)
                                    <div class="row">
                                        <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal">
                                            <input type="hidden" name="cmd" value="_xclick" />
                                            <input type="hidden" name="business" value="{{ $payment->paypal_email }}" />
                                            <input type="hidden" name="cbt" value="{{ $site_title }}" />
                                            <input type="hidden" name="currency_code" value="USD" />
                                            <input type="hidden" name="quantity" value="1" />
                                            <input type="hidden" name="item_name" value="Add Fund to {{ $site_title }}" />

                                            <!-- Custom value you want to send and process back in the IPN -->
                                            <input type="hidden" name="custom" value="{{ $fund->transaction_id }}" />

                                            <input name="amount" type="hidden" value="{{ $total  }}">
                                            <input type="hidden" name="return" value="{{ route('add-fund') }}"/>
                                            <input type="hidden" name="cancel_return" value="{{ route('add-fund') }}" />
                                            <!-- Where to send the PayPal IPN to. -->
                                            <input type="hidden" name="notify_url" value="{{ route('paypal-ipn') }}" />

                                            <div class="form-group">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <button class="btn btn-danger btn-block btn-icon icon-left"><i
                                                                class="fa fa-send"></i>Add Fund Now</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @elseif($fund->payment_type == 2)
                                        <div class="row">
                                            <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="myform">
                                                <input type="hidden" name="PAYEE_ACCOUNT" value="{{ $payment->perfect_account }}">
                                                <input type="hidden" name="PAYEE_NAME" value="{{ $site_title }}">
                                                <input type='hidden' name='PAYMENT_ID' value='{{ $fund->transaction_id }}'>
                                                <input type="hidden" name="PAYMENT_AMOUNT"  value="{{ round(($total),2)  }}">
                                                <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                                <input type="hidden" name="STATUS_URL" value="{{ route('perfect-ipn') }}">
                                                <input type="hidden" name="PAYMENT_URL" value="{{ route('add-fund') }}">
                                                <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
                                                <input type="hidden" name="NOPAYMENT_URL" value="{{ route('add-fund') }}">
                                                <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
                                                <input type="hidden" name="SUGGESTED_MEMO" value="{{ $site_title }}">
                                                <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>

                                                <div class="form-group">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <button class="btn btn-danger btn-block btn-icon icon-left"><i
                                                                    class="fa fa-send"></i>Add Fund Now</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @elseif($fund->payment_type == 3)

                                        <div class="row">
                                            {!! Form::open(['route'=>'btc-preview']) !!}
                                            <input type="hidden" name="amount" value="{{ round(($total),3)  }}">
                                            <input type="hidden" name="fund_id" value="{{ $fund->id }}">
                                            <input type="hidden" name="transaction_id" value="{{ $fund->transaction_id }}">
                                            <input type="hidden" name="charge" value="{{ $charge }}">
                                            <div class="form-group">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <button class="btn btn-danger btn-block btn-icon icon-left"><i
                                                                class="fa fa-send"></i>Add Fund Now</button>
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </div>

                                    @elseif($fund->payment_type == 4)
                                        <div class="row">
                                            {!! Form::open(['route'=>'stripe-preview']) !!}
                                            <input type="hidden" name="amount" value="{{ round(($total),2)  }}">
                                            <input type="hidden" name="fund_id" value="{{ $fund->id }}">
                                            <input type="hidden" name="transaction" value="{{ $fund->transaction_id }}">
                                            <input type="hidden" name="charge" value="{{ $charge }}">
                                                <div class="form-group">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <button class="btn btn-danger btn-block btn-icon icon-left"><i
                                                                    class="fa fa-send"></i>Add Fund Now</button>
                                                    </div>
                                                </div>
                                            {{ Form::close() }}
                                        </div>
                                    @endif

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
    <script type='text/javascript'>

        jQuery(document).ready(function(){

            $('#amount').on('input', function() {
                var amount = $("#amount").val();
                var plan = $("#plan").val();
                $.post(
                        '{{ url('/deposit-amount') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            amount : amount,
                            plan : plan
                        },
                        function(data) {
                            $("#result").html(data);
                        }
                );
            });
        });
    </script>

@endsection

