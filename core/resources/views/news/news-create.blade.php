@extends('layouts.dashboard')
@section('style')

    <script type="text/javascript" src="{{ asset('assets/dashboard/js/nicEdit.js') }}">

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
                            <label class="col-sm-3 control-label">News Category : </label>

                            <div class="col-sm-8">
                                <select name="category_id" id="" class="form-control input-lg" required>
                                    <option value="">Select One</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">News Title : </label>

                            <div class="col-sm-8">
                                <input type="text" name="title" id="" class="form-control input-lg" required placeholder="News Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">News Description : </label>

                            <div class="col-sm-8">
                                <textarea name="description" class="form-control input-lg" id="area1" cols="30" rows="10" required placeholder="News Description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-8">
                                    <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-info btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Create New News</button>
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


@endsection

