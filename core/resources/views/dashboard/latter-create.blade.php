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
                            <label class="col-sm-3 control-label">Latter Subject: </label>

                            <div class="col-sm-8">
                                <input type="text" name="subject" id="" class="form-control input-lg" required placeholder="Latter Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Receive User : </label>

                            <div class="col-sm-6">
                                <select name="user_id[]" id="e1" class="select2" multiple required>
                                    @foreach($user as $u)
                                    <option value="{{ $u->id }}" >{{ $u->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="checkbox">Select All
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Latter Description : </label>

                            <div class="col-sm-8">
                                <textarea name="description" class="form-control input-lg" id="area1" cols="30" rows="10" required placeholder="Latter Description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-offset-3 col-md-8">
                                    <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-info btn-block margin-top-10"><i class="fa fa-paper-plane"></i> Send This Latter</button>
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

    <script>
        $("#checkbox").click(function(){
            if($("#checkbox").is(':checked') ){
                $("#e1 > option").prop("selected","selected");
                $("#e1").trigger("change");
            }else{
                $("#e1 > option").removeAttr("selected");
                $("#e1").trigger("change");
            }
        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/select2.css') }}">

    <!-- Imported scripts on this page -->
    <script src="{{ asset('assets/dashboard/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/typeahead.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/jquery.selectBoxIt.min.js') }}"></script>

@endsection

