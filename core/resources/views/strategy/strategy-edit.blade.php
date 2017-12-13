
@extends('layouts.dashboard')
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
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
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
                            {{ Form::model($strategy,['route'=>['strategy-update',$strategy->id],'class'=>'form-horizontal','files'=>true,'method'=>'PUT']) }}
                            {!! csrf_field() !!}
                            <div class="form-group error">
                                <label for="inputTask" class="col-sm-3 control-label">Strategy Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="title" name="title" required placeholder="Strategy title" value="{{ $strategy->title }}">
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group error">

                                <div class="col-sm-9 col-sm-offset-3">
                                    <img src="{{ asset('assets/images') }}/{{ $strategy->image }}" alt="">
                                </div>
                            </div>
                            <div class="form-group error">
                                <label for="inputTask" class="col-sm-3 control-label">Strategy Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control has-error" id="image" name="image" value="">
                                    <span style="color: red;margin-top: 5px;">PNG Image Recommended. Size 112 X 104 </span>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group error">
                                <label for="inputTask" class="col-sm-3 control-label">Strategy Description</label>
                                <div class="col-sm-9">
                                <textarea name="description" id="description" cols="30" rows="5"
                                          class="form-control" required>{{ $strategy->description }}</textarea>
                                    <p class="error text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group error">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="submit" class="btn btn-danger btn-block btn-icon icon-left"><i class="fa fa-send"></i> Update Strategy</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>

@endsection