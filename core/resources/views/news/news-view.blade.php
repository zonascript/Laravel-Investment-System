@extends('layouts.dashboard')
@section('content')

    <div class="col-md-12" >

    <div class="panel panel-success" data-collapsed="0">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title">
                <a href="{{ route('news-create') }}" class="btn btn-info pull-right" >
                    <i class="entypo-plus"></i> Add New News
                </a>
            </div>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>
        <!-- panel body -->
        <div class="panel-body">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <div style="width: 100%;" class="panel-title text-center">
                        <p><b>{{ $news->title }}</b></p>
                        <span><i class="fa fa-list"></i> News Category : {{ $news->category->name }}</span>
                        &nbsp;&nbsp;&nbsp;<span><i class="fa fa-clock-o"></i> Posted At : {{ date('d-F-Y',strtotime($news->created_at)) }}</span>

                    </div>
                </div>
                <div class="panel-body">
                    <p class="lead">
                        {!! $news->description !!}
                    </p>
                </div>
                <div style="overflow: hidden" class="panel-footer text-center">
                    <div class="col-sm-4 col-sm-offset-2">
                        <a href="{{ route('news-edit',$news->id) }}" class="btn btn-info btn-block btn-icon icon-left btn-sm">
                            <i class="fa fa-edit"></i> Edit News
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger btn-sm btn-icon btn-block icon-left delete_button"
                                data-toggle="modal" data-target="#DelModal"
                                data-id="{{ $news->id }}">
                            <i class="fa fa-trash"></i> Delete News
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
        </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete this.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('delete-news') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>




@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection




