@extends('layouts.dashboard')
@section('style')

    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js">

    </script>
    <script type="text/javascript">
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
                    {!! Form::open(['method'=>'post','class'=>'form-horizontal']) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Menu Name : </b></label>

                            <div class="col-sm-8">
                                <input type="text" name="name" id="" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><b>Menu Description : </b></label>

                            <div class="col-sm-8">
                                <textarea name="description" id="area1" cols="30" rows="10"
                                          class="form-control input-lg" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-8">
                                    <button type="submit" class="btn btn-blue btn-block margin-top-10" onclick="nicEditors.findEditor('area1').saveContent();"><i class="entypo-direction"></i> Update New Menu</button>
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
