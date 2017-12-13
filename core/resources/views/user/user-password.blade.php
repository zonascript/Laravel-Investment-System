@extends('layouts.user')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">
    <style>
        .btn{
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-2 col-sm-12">
              </div>
        <div class="col-md-7 col-sm-12">
            <div class="panel panel-info" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><strong><i class="fa fa-edit"></i> &nbsp;Update User Password</strong></div>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    {!! Form::model($member,['route'=>['user-password-update',$member->id],'method'=>'put','class'=>'form-horizontal']) !!}

                    <div class="form-group">
                        <label style="margin-top: 0px;font-size: 14px;" class="col-sm-4 text-right control-label">Current Password : </label>

                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="current_password" value="" placeholder="Current Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="margin-top: 0px;font-size: 14px;" class="col-sm-4 text-right control-label">New Password : </label>

                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" value="" placeholder="New Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="margin-top: 0px;font-size: 14px;" class="col-sm-4 text-right control-label">Confirm Password : </label>

                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password_confirmation" value="" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-sm-7 col-sm-offset-4">
                            <button class="btn btn-danger btn-block btn-icon icon-left"><i class="fa fa-send"></i> Update User Password</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/dashboard/js/clipboard.min.js') }}"></script>
    <script>
        new Clipboard('.has');
    </script>
    <script src="{{ asset('assets/dashboard/js/fileinput.js') }}"></script>
@endsection