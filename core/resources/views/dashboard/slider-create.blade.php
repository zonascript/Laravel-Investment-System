@extends('layouts.dashboard')
@section('title', 'Currency Edit')
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

                    {!! Form::open(['method'=>'post','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Slider Small text : </b></label>

                            <div class="col-sm-6">
                                <input name="title" value="" class="form-control input-lg" type="text" required placeholder="Slider Small Text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Slider Bold text : </b></label>

                            <div class="col-sm-6">
                                <input name="description" value="" class="form-control input-lg" type="text" required placeholder="Slider Bold Text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Slider Image : </b></label>

                            <div class="col-sm-6">
                                <input type="file" name="image" id="" class="form-control input-lg" required>
                                <br><p style="color:red"><b><i>Image Resize 1920 X 650px. Image Type PNG & JPEG</i></b></p>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn btn-blue btn-block margin-top-10"><i class="entypo-direction"></i> Create New Slider</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>

            </div>

        </div>
    </div>


@endsection

