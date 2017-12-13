@extends('layouts.dashboard')
@section('style')
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        //]]>
    </script>
@endsection
@section('content')

    <div class="panel panel-success" data-collapsed="0">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title">{{ $page_title }}</div>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>

        <!-- panel body -->
        <div class="panel-body">

                {{ Form::model($page,['route'=>['about-update',$page->id],'class'=>'form-horizontal','files'=>true,'method'=>'PUT']) }}

                <div class="text-center">

                    <h3>{{ $page_title }}</h3>
                </div>
            <hr>
                <div class="form-group error">
                    <div class="col-sm-12">
                    <textarea name="about" id="area1" cols="30" rows="20"
                              class="form-control" required>{{ $page->about }}</textarea>
                        <p class="error text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <hr>
                <div class="form-group error">
                    <div class="col-sm-12">
                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-danger btn-block btn-icon icon-left"><i class="fa fa-send"></i> Update About Page</button>
                    </div>
                </div>
                {{ Form::close() }}


            </div>

    </div>



@endsection