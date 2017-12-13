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
                                <div class="panel panel-info panel-pricing">
                                    <div class="panel-heading">
                                        <h3 style="font-size: 28px;"><b>{{ $method->title }}</b></h3>
                                    </div>
                                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                        <p><strong>{{ $amount }} - {{ $basic->currency }} </strong></p>
                                    </div>
                                    <ul style='font-size: 15px;' class="list-group text-center bold">
                                        <li class="list-group-item"><i class="fa fa-check"></i> Fixed Charge - {{ $method->method_fix }} - {{ $basic->currency }}</li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Transaction Percent - {{ $method->method_percent }} <i class="fa fa-percent"></i> </li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Time - <span class="aaaa">{{ $method->method_time }} - Days</span></li>
                                    </ul>
                                    <div class="panel-footer" style="overflow: hidden">
                                        <div class="col-sm-12">
                                            <a href="{{ route('withdraw-new') }}" class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-arrow-left"></i> Withdraw With Other Method</a>
                                        </div>
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
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-2 text-right control-label">Request Amount : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ $amount }}" readonly name="amount" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-2 text-right control-label">Withdrawal Charge : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ $method->method_fix + (($amount * $method->method_percent) /100) }}" readonly name="charge" id="charge" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-2 text-right control-label">Total Charge : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ $amount + $method->method_fix + (($amount * $method->method_percent) /100) }}" readonly name="charge" id="charge" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-2 text-right control-label">Available Balance : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ Auth::user()->amount - ($amount + $method->method_fix + (($amount * $method->method_percent) /100)) }}" readonly name="charge" id="charge" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="panel panel-info panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title"><i class="fa fa-send"></i> <strong>Payment Send Details</strong></div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body">
                                <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                                    <div class="panel panel-info panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                                        <!-- panel head -->
                                        <div class="panel-heading">
                                            <div class="panel-title"><i class="fa fa-send"></i> <strong>Details</strong></div>
                                        </div>
                                        <!-- panel body -->
                                        <div class="panel-body">
                                            {!! Form::open(['route'=>'withdraw-submit']) !!}
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="method_id" value="{{ $method->id }}">

                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Bank Name : </label>

                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" value="{{ $method->title }}" readonly name="method_name" id="charge" class="form-control" placeholder="Enter Deposit Amount" required>
                                                            <span class="input-group-addon red">&nbsp;<strong> <i class="fa fa-bank"></i></strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Account Name : </label>

                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" value="" name="acc_name" id="" class="form-control" placeholder="Enter Account Name" required>
                                                            <span class="input-group-addon red">&nbsp;<strong> <i class="fa fa-address-card"></i></strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Account Number : </label>

                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" value="" name="acc_number" id="" class="form-control" placeholder="Enter Account Number" required>
                                                            <span class="input-group-addon red">&nbsp;<strong> <i class="fa fa-sort-numeric-asc"></i></strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Swift Code : </label>

                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" value="" name="acc_code" id="" class="form-control" placeholder="Enter Swift Code" required>
                                                            <span class="input-group-addon red">&nbsp;<strong> <i class="fa fa-key"></i></strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                            <div class="form-group">
                                                <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Message  : </label>

                                                <div class="col-sm-8">

                                                    <textarea name="message" id="" cols="30" rows="3"
                                                              class="form-control" placeholder="Message ( If Any )"></textarea>
                                                </div>
                                            </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group">

                                                    <div class="col-sm-8 col-sm-offset-4">
                                                        <button class="btn btn-danger btn-icon icon-left btn-block"><i class="fa fa-send"></i> Submit Withdraw</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
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

