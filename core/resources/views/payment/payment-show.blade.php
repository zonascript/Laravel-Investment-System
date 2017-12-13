@extends('layouts.dashboard')
@section('style')

    <link href="{{ asset('assets/dashboard/css/bootstrap-toggle.min.css') }}" rel="stylesheet">

@endsection
@section('content')

    <div class="col-md-12" >

        <div class="panel panel-success" data-collapsed="0">

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>{{ $page_title }}</strong>
                </div>
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>
            <!-- panel body -->
            <div class="panel-body">

                {!! Form::model($payment,['route'=>['payment-manage-update',$payment->id],'method'=>'PUT','files'=>true]) !!}


                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <i class="fa fa-cc-paypal"></i>  <b>PayPal Payment</b>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><i class="fa fa-cc-paypal"></i> PayPal Details</h1>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                            <div class="col-md-9">
                                                <input name="paypal_image" class="form-control" type="file">
                                                <br>
                                                <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-md-3">
                                                <img src="{{ asset('assets/images') }}/{{ $payment->paypal_image }}" alt="Display Image" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                            <div class="col-md-12">
                                                <input class="form-control" name="paypal_name" value="{{ $payment->paypal_name }}" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <span class="input-group-addon">1 USD = </span>
                                                    <input class="form-control" name="paypal_rate" value="{{ $payment->paypal_rate }}" type="text" required>
                                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="paypal_min" value="{{ $payment->paypal_min }}" required type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="paypal_max" value="{{ $payment->paypal_max }}" required type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="paypal_fix" value="{{ $payment->paypal_fix }}" required type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="paypal_percent" value="{{ $payment->paypal_percent }}" required type="text">
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group" style="margin-top: 20px;margin-bottom: 105px;">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">PayPal Business Email</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="paypal_email" value="{{ $payment->paypal_email }}" required type="text">
                                                    <span class="input-group-addon"><b>@</b></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                            <div class="col-md-12">
                                                <input data-toggle="toggle" {{ $payment->paypal_status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="onoffswitch2">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <strong><i class="fa fa-credit-card-alt"></i> Perfect Money</strong>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-credit-card-alt"></i> Perfect Money</strong></h1>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                            <div class="col-md-9">
                                                <input name="perfect_image" class="form-control" type="file">
                                                <br>
                                                <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-md-3">
                                                <img src="{{ asset('assets/images') }}/{{ $payment->perfect_image }}" alt="Display Image" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                            <div class="col-md-12">
                                                <input class="form-control" name="perfect_name" value="{{ $payment->perfect_name }}" required type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <span class="input-group-addon">1 USD = </span>
                                                    <input class="form-control" name="perfect_rate" value="{{ $payment->perfect_rate }}" type="text">
                                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="perfect_min" value="{{ $payment->perfect_min }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="perfect_max" value="{{ $payment->perfect_max }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="perfect_fix" value="{{ $payment->perfect_fix }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="perfect_percent" value="{{ $payment->perfect_percent }}" type="text">
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect Money USD Account</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="perfect_account" value="{{ $payment->perfect_account }}" type="text">
                                                    <span class="input-group-addon"><i class="fa fa-vcard"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect Money Alternate Passphrase  </strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="perfect_alternate" value="{{ $payment->perfect_alternate }}" type="text">
                                                    <span class="input-group-addon"><i class="fa fa-bolt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                            <div class="col-md-12">

                                                <input data-toggle="toggle" {{ $payment->perfect_status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="onoffswitch3">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <strong><i class="fa fa-btc"></i> BlockChain - (BITCOIN)</strong>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-btc"></i> BlockChain - (BITCOIN)</strong></h1>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                            <div class="col-md-9">
                                                <input name="btc_image" class="form-control" type="file">
                                                <br>
                                                <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-md-3">
                                                <img src="{{ asset('assets/images') }}/{{ $payment->btc_image }}" alt="Display Image" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                            <div class="col-md-12">
                                                <input class="form-control" name="btc_name" value="{{ $payment->btc_name }}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <span class="input-group-addon">1 USD = </span>
                                                    <input class="form-control" name="btc_rate" value="{{ $payment->btc_rate }}" type="text">
                                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="btc_min" value="{{ $payment->btc_min }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="btc_max" value="{{ $payment->btc_max }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="btc_fix" value="{{ $payment->btc_fix }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="btc_percent" value="{{ $payment->btc_percent }}" type="text">
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin API Key</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="btc_api" value="{{ $payment->btc_api }}" type="text">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin XPUB Code  </strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="btc_xpub" value="{{ $payment->btc_xpub }}" type="text">
                                                    <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                            <div class="col-md-12">

                                                <input data-toggle="toggle" {{ $payment->btc_status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="onoffswitch4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <strong><i class="fa fa-cc-stripe"></i> Stripe (CARD)</strong>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-cc-stripe"></i> Stripe (CARD)</strong></h1>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                            <div class="col-md-9">
                                                <input name="stripe_image" class="form-control" type="file">
                                                <br>
                                                <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                                <br>
                                                <br>
                                            </div>
                                            <div class="col-md-3">
                                                <img src="{{ asset('assets/images') }}/{{ $payment->stripe_image }}" alt="Display Image" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                            <div class="col-md-12">
                                                <input class="form-control" name="stripe_name" value="{{ $payment->stripe_name }}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <span class="input-group-addon">1 USD = </span>
                                                    <input class="form-control" name="stripe_rate" value="{{ $payment->stripe_rate }}" type="text">
                                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="stripe_min" value="{{ $payment->stripe_min }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="stripe_max" value="{{ $payment->stripe_max }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="stripe_fix" value="{{ $payment->stripe_fix }}" type="text">
                                                            <span class="input-group-addon">{{ $basic->currency }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb15">
                                                            <input class="form-control" name="stripe_percent" value="{{ $payment->stripe_percent }}" type="text">
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- row 2nd   -->
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">SECRET KEY</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="stripe_secret" value="{{ $payment->stripe_secret }}" type="text">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">PUBLISHER KEY</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="stripe_publisher" value="{{ $payment->stripe_publisher }}" type="text">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                            <div class="col-md-12">

                                                <input data-toggle="toggle" {{ $payment->stripe_status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="onoffswitch5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-info btn-block"><i class="fa fa-send"></i> <strong>Save Changes</strong></button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>




@endsection
@section('scripts')

    <script src="{{ asset('assets/dashboard/js/bootstrap-toggle.min.js') }}"></script>

@endsection