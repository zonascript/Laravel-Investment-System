@extends('layouts.dashboard')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">
    <link href="{{ asset('assets/dashboard/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
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
                    {!! Form::model($plan,['route'=>['plan-update',$plan->id],'method'=>'put','class'=>'form-horizontal','files'=>true]) !!}

                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Plan Name : </label>

                            <div class="col-sm-6">
                                <input type="text" name="name" value="{{ $plan->name }}" id="" class="form-control input-lg" required placeholder="Plan Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Plan Image : </label>

                            <div class="col-sm-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{ asset('assets/images') }}/{{ $plan->image }}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="image" accept="image/*">
                                    </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Minimum Amount : </label>

                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="minimum" value="{{ $plan->minimum }}" required type="text" placeholder="Minimum Amount">
                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Maximum Amount : </label>

                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="maximum" value="{{ $plan->maximum }}" required type="text" placeholder="Maximum Amount">
                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Repeat Percentage : </label>

                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon">{{ $basic->symbol }}</span>
                                    <input class="form-control input-lg" name="percent" value="{{ $plan->percent }}" required type="text" placeholder="Repeat Percentage">
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Repeat Time : </label>

                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control input-lg" name="time" value="{{ $plan->time }}" required type="text" placeholder="Repeat Time">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Repeat Compound : </label>

                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    {{--<input class="form-control input-lg" name="compound" value="" required type="text" placeholder="Invest Compound">--}}
                                    <select name="compound_id" id="" class="form-control input-lg" required>
                                        <option value="">Select One</option>
                                        @foreach($compound as $c)
                                            @if($plan->compound_id == $c->id)
                                            <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                            @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Plan Status : </label>

                            <div class="col-sm-6">

                                <input data-toggle="toggle" {{ $plan->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn btn-info btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Update Plan</button>
                                </div>
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
    <script src="{{ asset('assets/dashboard/js/fileinput.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap-toggle.min.js') }}"></script>


@endsection

