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

                    <div class="row">
                        @foreach($slider as $s)
                        <div class="col-md-6">
                            <img style="width: 100%" src="{{ asset('assets/images') }}/{{ $s->image }}" alt="">
                            <hr>
                            <strong>Small Text : </strong>{{ $s->title }}<br>
                            <strong>Bold Text : </strong>{{ $s->description }}<br><br>
                            <a href="{{ route('slider-edit',$s->id) }}" class="btn btn-primary"><i class="entypo-pencil"></i> Edit Slider</a>
                            <button type="button" class="btn btn-danger btn-icon icon-left delete_button"
                                    data-toggle="modal" data-target="#DelModal"
                                    data-id="{{ $s->id }}">
                                <i class='entypo-trash'></i> Delete Slider
                            </button>
                        </div>
                        @endforeach
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('slider-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">DELETE</button>
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


@endsection

