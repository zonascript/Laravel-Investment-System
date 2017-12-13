@extends('layouts.dashboard')
@section('style')
    <style>
        td,th{
            font-size: 15px;
        }
    </style>
@endsection
@section('content')

    <div class="col-md-12" >
        <button id="btn-add" name="btn-add" style="margin-bottom: 20px;" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Bank</button>
    </div>

    <table class="table table-striped table-hover table-bordered datatable" id="table-4">
        <thead>
        <tr>
            <th>No</th>
            <th>Bank Name</th>
            <th>Account Name</th>
            <th>Account Number</th>
            <th>Swift Code</th>
            <th>Limit</th>
            <th>Charge</th>
            <th>Status</th>
            <th>Documentation</th>
        </tr>
        </thead>
        <tbody id="tasks-list" name="tasks-list">
        <?php $no=0; ?>
        @foreach ($bank as $cat)
            <?php $no++; ?>
            <tr id="task{{$cat->id}}">
                <td>{{$no}}</td>
                <td>{{ $cat->name }}</td>
                <td>
                    {{ $cat->acc_name }}
                </td>
                <td>
                    {{ $cat->acc_number }}
                </td>
                <td>
                    {{ $cat->acc_code }}
                </td>
                <td width="14%">{{ $basic->symbol }} {{ $cat->minimum }} - {{ $basic->symbol }} {{ $cat->maximum }}</td>
                <td width="13%">{{ $basic->symbol }} {{ $cat->fix }} - {{ $cat->percent }} <i class="fa fa-percent"></i></td>
                <td>
                    @if($cat->status == 1)
                        <button title="Do Deactive" type="button" class="btn btn-danger btn-sm delete_button1"
                                data-toggle="modal" data-target="#DelModal"
                                data-id="{{ $cat->id }}">
                            <i class="fa fa-eye-slash"></i>
                        </button>
                    @else
                        <button title="Do Active" type="button" class="btn btn-success btn-sm delete_button"
                                data-toggle="modal" data-target="#DelModal1"
                                data-id="{{ $cat->id }}">
                            <i class="fa fa-eye"></i>
                        </button>
                    @endif
                </td>
                <td>
                    <button class="btn btn-info btn-sm btn-detail open-modal" value="{{$cat->id}}"><i class="fa fa-edit"></i></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <meta name="_token" content="{!! csrf_token() !!}" />


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Manage Bank</h4>
                </div>
                <div class="modal-body">
                    <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Bank Name :</label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="name" id="name" value="" type="text" required>
                                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Account Name :</label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="acc_name" id="acc_name" value="" type="text" required>
                                    <span class="input-group-addon"><i class="fa fa-file-word-o"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Account Number :</label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="acc_number" id="acc_number" value="" type="text" required>
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Swift Code :</label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="acc_code" id="acc_code" value="" type="text" required>
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Fixed Charge : </label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="fix" id="fix" value="" type="text" required>
                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Percentage : </label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="percent" id="percent" value="" type="text" required>
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Minimum Amount : </label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="minimum" id="minimum" value="" type="text" required>
                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 col-sm-offset-1 control-label">Maximum Amount : </label>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <input class="form-control" name="maximum" id="maximum" value="" type="text" required>
                                    <span class="input-group-addon">{{ $basic->currency }}</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-4 text-right">
                            <button type="button" class="btn btn-info btn-block btn-icon icon-left" id="btn-save" value="add"><i class="fa fa-send"></i> Save Bank</button>
                            <input type="hidden" id="task_id" name="task_id" value="0">
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
                    <strong>Are you sure you want to Deactivated this.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-deactive') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="DelModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Active this.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-active') }}" class="form-inline">
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
        $(document).ready(function () {

            $(document).on("click", '.delete_button1', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>
    <script>

        jQuery( document ).ready( function( $ ) {

            var url = '{{ url('/admin/manual-payment') }}';
            var symbol = '{{ $basic->symbol }}';

            //display modal form for creating new task
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });

            //create new task / update existing task

            $("#btn-save").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                e.preventDefault();

                var formData = {
                    'name': $('#name').val(),
                    'acc_name': $('#acc_name').val(),
                    'acc_number': $('#acc_number').val(),
                    'acc_code': $('#acc_code').val(),
                    'fix': $('#fix').val(),
                    'percent': $('#percent').val(),
                    'minimum': $('#minimum').val(),
                    'maximum': $('#maximum').val(),
                    'type_id': $('#type_id').val()
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save').val();

                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();;
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    my_url += '/' + task_id;
                }

                console.log(formData);

                $.ajax({

                    type: type,
                    url: my_url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.acc_name + '</td><td>' + data.acc_number + '</td><td>' + data.acc_code + '</td><td>' +symbol +" "+ data.minimum +" - " + symbol +" "+ data.maximum +'</td><td>' +symbol+" " + data.fix+ " - "+ data.percent +" "+'<i class="fa fa-percent"></i>'+'</td>';
                        task += '<td><button class="btn btn-success btn-sm delete_button" data-toggle="modal" data-target="' + data.id + '" ><i class="fa fa-eye"></i></button></td>';
                        task += '<td><button class="btn btn-info btn-sm btn-detail open-modal" value="' + data.id + '"><i class="fa fa-edit"></i></button></td>';

                        if (state == "add"){ //if user added a new record
                            $('#tasks-list').append(task);
                        }else{ //if user updated an existing record

                            $("#task" + task_id).replaceWith( task );
                        }
                        $('#frmTasks').trigger("reset");

                        $('#myModal').modal('hide');
                    },
                    error: function (data) {
                    }
                }) .done(function() {
                    swal('Success','Successfully Payment Method Saved.','success');
                });
            });

            //display modal form for task editing
            $('.open-modal').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                    //success data
                    console.log(data);
                    $('#task_id').val(data.id);
                    $('#name').val(data.name);
                    $('#acc_name').val(data.acc_name);
                    $('#acc_number').val(data.acc_number);
                    $('#acc_code').val(data.acc_code);
                    $('#fix').val(data.fix);
                    $('#percent').val(data.percent);
                    $('#minimum').val(data.minimum);
                    $('#maximum').val(data.maximum);
                    $('#type_id').val(data.type_id);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                })
            });

        });
    </script>


@endsection