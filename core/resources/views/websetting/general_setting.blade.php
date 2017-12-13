@extends('layouts.dashboard')

@section('style')

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
                    {!! Form::model($general,['route'=>['update_general',$general->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Website Name</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="title" value="{{ $general->title }}"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Website Logo</strong></label>

                            <div class="col-md-8">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Change Logo</strong></label>
                            <div class="col-md-8">
                                <input name="image" type="file" class="form-control"  />
                                <b style="color:red; margin-top:10px; font-weight: bold; float: right;margin-right: 10px">Image Must be PNG & Resize: 225x80</b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Website Favicon</strong></label>

                            <div class="col-md-8">
                                <img src="{{ asset('assets/images') }}/{{ $general->favicon }}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Change Favicon</strong></label>
                            <div class="col-md-8">
                                <input name="image1" type="file" class="form-control"  />

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">WebSite Base Color</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-droplet"></i></a>
                                    </div>

                                    <input style="color:#fff;background: #{{ $general->color }}" type="text" name="color" class="form-control colorpicker" data-format="hex" value="{{ $general->color }}" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Address</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="address" value="{{ $general->address }}"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Mobile</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="number" value="{{ $general->number }}"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Email</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="email" value="{{ $general->email }}"
                                       type="email">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Top Text Big</strong></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-lg" value="{{ $general->top_one }}" required name="top_one">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Top Text Small</strong></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-lg" value="{{ $general->top_two }}" required name="top_two">

                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Facebook</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="facebook" value="{{ $general->facebook }}"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Twitter</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="twitter" value="{{ $general->twitter }}"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Google Plus</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="google_plus" value="{{ $general->google_plus }}"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Linkedin</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="linkedin" value="{{ $general->linkedin }}"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Youtube</strong></label>

                            <div class="col-md-8">
                                <input class="form-control input-lg" name="youtube" value="{{ $general->youtube }}"
                                       type="text">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>About Short Text</strong></label>
                            <div class="col-md-8">
                                <textarea name="about_text" class=" form-control input-lg" id="" cols="30" rows="5">{{ $general->about_text }}</textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Copyright Text</strong></label>
                            <div class="col-md-8">
                                <textarea name="footer_bottom_text" class=" form-control input-lg" id="" cols="30" rows="2">{{ $general->footer_bottom_text }}</textarea>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-8">
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
    {{--<script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>--}}

@endsection