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
                    <div class="panel-title"><i class="fa fa-send"></i> <strong></strong></div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <div class="row">
                    <!-- <div class="col-md-4">
                            <div class="col-sm-12 text-center">
                                <div class="panel panel-info panel-pricing">
                                    <div class="panel-heading">
                                        <h3 style="font-size: 28px;"><b>{{ $method->name }}</b></h3>
                                    </div>
                                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                        <p><strong>{{ $fund->amount }} - {{ $basic->currency }} </strong></p>
                                    </div>
                                    <ul style='font-size: 15px;' class="list-group text-center bold">
                                        <li class="list-group-item"><i class="fa fa-check"></i> Fixed Charge - {{ $method->fix }} - {{ $basic->currency }}</li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Transaction Percent - {{ $method->percent }} <i class="fa fa-percent"></i> </li>
                                    </ul>
                                    <div class="panel-footer" style="overflow: hidden">
                                        <div class="col-sm-12">
                                            <a href="{{ route('manual-fund-add') }}" class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-arrow-left"></i> Another Method</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <div class="panel panel-info panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-money"></i> <strong>Amount Deposited to Bank</strong></div>
                                </div>
                                <!-- panel body -->
                                <div class="panel-body">
                                    <div class="text-center">
                                    <!-- <h3>Current Balance : <strong>{{ Auth::user()->amount }} - {{ $basic->currency }}</strong></h3>-->
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-2 text-right control-label">Deposited Amount : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ $fund->amount }}" readonly name="amount" id="amount" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="row">
                                    <!-- <div class="form-group">
                                            <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-2 text-right control-label"> Balance Will Be : </label>

                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" value="{{ Auth::user()->amount + $fund->amount }}" readonly name="charge" id="charge" class="form-control" placeholder="Enter Deposit Amount" required>
                                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                </div>
                                            </div>
                                        </div> -->
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
                                <div class="panel-title"><i class="fa fa-send"></i> <strong>Banking Details</strong></div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body">
                                <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                                    <div class="panel panel-info panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                                        <!-- panel head -->
                                        <div class="panel-heading">
                                            <div class="panel-title"><i class="fa fa-send"></i> <strong> Attach Proof of Deposit Here </strong></div>
                                        </div>
                                        <!-- panel body -->
                                        <div class="panel-body">
                                            {!! Form::open(['route'=>'manual-fund-submit','files'=>true]) !!}
                                            <input type="hidden" name="amount" value="{{ $fund->amount }}">
                                            <input type="hidden" name="method_id" value="{{ $fund->bank_id }}">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Payment Method : </label>                                                    <div class="col-sm-8">
                                                        <input type="text" name="" id="" value="{{ $fund->method->name }}" class="form-control" readonly >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Account Name : </label>                                                    <div class="col-sm-8">
                                                        <input type="text" name="" id="" value="{{ $fund->method->acc_name }}" class="form-control" readonly >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Account Number : </label>                                                    <div class="col-sm-8">
                                                        <input type="text" name="" id="" value="{{ $fund->method->acc_number }}" class="form-control" readonly >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Branch Code : </label>                                                    <div class="col-sm-8">
                                                        <input type="text" name="" id="" value="{{ $fund->method->acc_code }}" class="form-control" readonly >
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="log_id" value="{{ $fund->id }}">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Amount : </label>

                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" value="{{ $fund->total }}" readonly name="amount" id="charge" class="form-control" placeholder="Enter Deposit Amount" required>
                                                            <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 text-right control-label">Proof of Deposit : </label>

                                                    <div class="col-sm-6">
                                                        <div class="" style="width: 100%;">
                                                        <input required name="image[]" type="file" class="form-control file2 inline btn btn-primary" multiple="1" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Images" /></div>
                                                        <span style="color: green;">Only Images are allowed</span>
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
                                                        <button class="btn btn-success btn-icon icon-left btn-block"><i class="fa fa-send"></i> Send</button>
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

