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
        <div class="col-md-5 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title"><strong><i class="fa fa-user"></i> User Photo</strong></div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <div style="margin-bottom: 0;padding-bottom: 10px;" class="well well-lg">
                        <div class="profile-body text-center">
                            <h3 style="margin-top: 0;margin-bottom: 15px;">{{ $member->name }}</h3>
                            <button style="margin-top: 10px;" class="btn has btn-block btn-info btn-icon icon-left" data-clipboard-text="{{ $member->reference }}">
                                <i class="fa fa-clipboard" aria-hidden="true"></i>  Copy Reference
                            </button>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <a href="{{ route('user-edit') }} " class="btn btn-info btn-icon icon-left btn-block"><i class="fa fa-edit"></i> Edit User Details</a>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12 col-sm-12">

									
                                    @foreach($withdrawalcnt as $c)
										@if( $member->name == $c->name )
											@continue;
										@endif	
											<a href="../user/switch/start/{{$c->id}}" class="btn btn-info btn-icon icon-left btn-block"> 
												<i class="entypo-pencil"></i>View {{$c->name}}'s Account<br>
											</a>
										
                                    @endforeach                             
														
									@if( Session::has('orig_user') )
									<a href="../user/switch/stop" class="btn btn-info btn-icon icon-left btn-block">Switch back to Parent Account</a>
									@endif
									
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">

                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-danger btn-icon icon-left btn-block"><i class="fa fa-sign-out"></i> User Log Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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