@extends('layouts.dashboard')

@section('style')
    <link href="{{ asset('assets/dashboard/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
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
                    <div class="panel-title">{{ $page_title }}</div>

                </div>

                <!-- panel body -->
                <div class="panel-body">
                    {!! Form::model($basic,['route'=>['basic-update',$basic->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="col-md-10 col-md-offset-1">

                            <div class="panel panel-success" data-collapsed="0">

                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title">User Management</div>

                                    <div class="panel-options">
                                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>User Registration : </b></label>
                                        <div class="col-sm-5">
                                            <input data-toggle="toggle" {{ $basic->registration_status == 1 ? "checked" : "" }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="registration_status">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Google reCaptcha Verification : </b></label>
                                        <div class="col-sm-5">
                                            <input data-toggle="toggle" {{ $basic->reCaptcha_status == 1 ? "checked" : "" }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="reCaptcha_status">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field-2" class="col-sm-4 control-label">Google reCaptcha Site Key :</label>

                                        <div class="col-sm-5">
                                            <input type="text" value="{{ $basic->site_key }}" name="site_key" class="form-control" id="field-2" placeholder="Google reCaptcha Site Key ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-4 control-label">Google reCaptcha Secret Key :</label>

                                        <div class="col-sm-5">
                                            <input type="text" name="secret_key" value="{{ $basic->secret_key }}" class="form-control" id="field-1" placeholder="Google reCaptcha Secret Key">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>User E-mail Verification : </b></label>
                                        <div class="col-sm-5">
                                            <input data-toggle="toggle" {{ $basic->verify_status == 1 ? "checked" : "" }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="verify_status">
                                        </div>
                                    </div>
                                
                                </div>

                            </div>
                            <div class="panel panel-info" data-collapsed="0">

                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title">Site Management</div>

                                    <div class="panel-options">
                                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Base Currency : </b></label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input name="currency" value="{{ $basic->currency }}" required type="text" class="form-control">
                                                <span class="input-group-addon"><i class="entypo-credit-card"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Cron Job Command : </b></label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input name="currency22" value="wget {{ url('/repeat-generator') }}" required type="text" readonly class="form-control bold warning">
                                                <span class="input-group-addon"><i class="entypo-link"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Currency Symbol : </b></label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="symbol" value="{{ $basic->symbol }}" required class="form-control">
                                                <span class="input-group-addon"><i class="entypo-info"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Withdraw Status : </b></label>
                                        <div class="col-sm-5">
                                            <input data-toggle="toggle" {{ $basic->withdraw_status == 1 ? "checked" : "" }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="withdraw_status">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Default Reference ID : </b></label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" value="{{ $basic->reference_id }}" name="reference_id" class="form-control">
                                                <span class="input-group-addon">&nbsp;<i class="fa fa-recycle"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Reference Bonus : </b></label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">{{ $basic->symbol }}</span>
                                                <input type="text" value="{{ $basic->reference_bonus }}" name="reference_bonus" class="form-control">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Reference Per Invest Commission : </b></label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">{{ $basic->symbol }}</span>
                                                <input type="text" value="{{ $basic->reference }}" name="reference" class="form-control">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" col-md-12">
                                <button type="submit" class="btn btn-blue btn-block"><i class="entypo-direction"></i> Save Changes</button>
                            </div>
                        </div>


                    </div>
                    {!! Form::close() !!}
                </div>
            </div>


        </div>
    </div><!---ROW-->


@endsection
@section('scripts')

    <script src="{{ asset('assets/dashboard/js/bootstrap-toggle.min.js') }}"></script>

@endsection