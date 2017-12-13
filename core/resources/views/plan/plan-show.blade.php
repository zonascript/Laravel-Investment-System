@extends('layouts.dashboard')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">

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

                    @foreach($plan as $p)

                    <div class="col-sm-4 text-center">
                        <div class="panel panel-success panel-pricing">
                            <div class="panel-heading">
                                <h3 style="font-size: 28px;"><b>{{ $p->name }}</b></h3>
                            </div>
                            <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                <p><strong>{{ $p->minimum }} {{ $basic->currency }} - {{ $p->maximum }} {{ $basic->currency }}</strong></p>
                            </div>
                            <ul style='font-size: 15px;' class="list-group text-center bold">
                                <li class="list-group-item"><i class="fa fa-check"></i> Commission - {{ $p->percent }} <i class="fa fa-percent"></i> </li>
                                <li class="list-group-item"><i class="fa fa-check"></i> Time - {{ $p->time }} times </li>
                                <li class="list-group-item"><i class="fa fa-check"></i> Compound - <span class="aaaa">{{ $p->compound->name }}</span></li>
                                <li class="list-group-item"><span class="aaaa">{{ $p->status == 1 ? "Active" : 'DeActive' }}</span></li>
                            </ul>
                            <div class="panel-footer" style="overflow: hidden">
                                <div class="col-sm-6">
                                    <a class="btn btn-block btn-success" href="{{ route('plan-edit',$p->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-danger btn-block delete_button"
                                            data-toggle="modal" data-target="#DelModal"
                                            data-id="{{ $p->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach


                </div>

            </div>
        </div>
    </div><!---ROW-->
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
                    <form method="post" action="{{ route('delete-plan') }}" class="form-inline">
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

@endsection

