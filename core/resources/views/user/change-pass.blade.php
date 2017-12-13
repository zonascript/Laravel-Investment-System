@extends('layouts.dashboard')
@section('title', 'Change password')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    <form class="form-horizontal" action="" method="post" role="form">
                        <div class="form-body">


                            {!! csrf_field() !!}


                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Current Password</strong></label>

                                <div class="col-md-6">
                                    <input class="form-control input-lg" name="current_password"
                                           placeholder="Current Password" type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>New Password</strong></label>

                                <div class="col-md-6">
                                    <input class="form-control input-lg" name="password" placeholder="New Password"
                                           type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>New Password Again</strong></label>

                                <div class="col-md-6">
                                    <input class="form-control input-lg" name="password_confirmation"
                                           placeholder="New Password Again" type="password">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn btn-blue btn-block"><i class="entypo-direction"></i> Change Password</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!---ROW-->







@endsection