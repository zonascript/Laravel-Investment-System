
@extends('layouts.dashboard')
@section('title', 'Change password')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    <form class="form-horizontal" action="{{ route('update-profile') }}" enctype="multipart/form-data" method="post" role="form">
                        <div class="form-body">

                            {!! csrf_field() !!}


                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Name</strong></label>

                                <div class="col-md-6">
                                    <input value="{{ $admin->name }}" class="form-control input-lg" name="name"
                                           placeholder="Admin Name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Admin Email</strong></label>

                                <div class="col-md-6">
                                    <input value="{{ $admin->email }}" class="form-control input-lg" name="email"
                                           placeholder="Admin Email" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Admin Image</strong></label>

                                <div class="col-md-6">
                                    <img style="width: 25%;" src="{{ asset('assets/images') }}/{{ $admin->image }}" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Change Admin Image</strong></label>

                                <div class="col-md-6">
                                    <input class="form-control input-lg" name="image" type="file">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn btn-blue btn-block"><i class="entypo-direction"></i> Update Profile</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!---ROW-->







@endsection

