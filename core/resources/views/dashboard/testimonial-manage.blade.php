@extends('layouts.dashboard')
@section('content')

    <div class="col-md-12" >
        <button id="btn-add" name="btn-add" style="margin-bottom: 20px;" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Testimonial</button>
    </div>
    <table class="table table-striped table-hover table-bordered datatable" id="table-4">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Position</th>
            <th>Description</th>
            <th>Documentation</th>
        </tr>
        </thead>
        <tbody id="tasks-list" name="tasks-list">
        <?php $no=0; ?>
        @foreach ($testimonial as $cat)
            <?php $no++; ?>
            <tr id="task{{$cat->id}}">
                <td>{{$no}}</td>
                <td>{{ $cat->name }}</td>
                <td width="15%">{{ $cat->position }}</td>
                <td>{{ $cat->description }}</td>
                <td>
                    <button class="btn btn-info btn-sm btn-detail btn-icon icon-left open-modal" value="{{$cat->id}}"><i class="fa fa-edit"></i> Edit Testimonial</button>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <div class="text-right">
        {{ $testimonial->links() }}
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> Manage Testimonial</h4>
                </div>
                <div class="modal-body">
                    <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="">
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Position</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="position" name="position" placeholder="Position" value="">
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" cols="30" rows="10"
                                          class="form-control has-error" placeholder="Description"></textarea>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add"><i class="fa fa-send"></i> Save Testimonial</button>
                    <input type="hidden" id="task_id" name="task_id" value="0">
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>

        $(document).ready(function () {

            var url = '{{ url('/admin/manage-testimonial') }}';

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
                    'position': $('#position').val(),
                    'description': $('#description').val(),
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

                $.ajax({

                    type: type,
                    url: my_url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td width="15%">'+ data.position +'</td><td>'+ data.description +'</td>';
                        task += '<td><button class="btn btn-info btn-sm btn-icon icon-left btn-detail open-modal" value="' + data.id + '"><i class="fa fa-edit"></i> Edit Testimonial</button>';

                        if (state == "add"){ //if user added a new record
                            $('#tasks-list').append(task);
                        }else{ //if user updated an existing record

                            $("#task" + task_id).replaceWith( task );
                        }

                        $('#frmTasks').trigger("reset");

                        $('#myModal').modal('hide');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                }) .done(function() {
                    swal('Success','Successfully Testimonial Saved.','success');
                });
            });

            //display modal form for task editing
            $('.open-modal').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                    //success data
                    $('#task_id').val(data.id);
                    $('#name').val(data.name);
                    $('#position').val(data.position);
                    $('#description').val(data.description);
                    $('#type_id').val(data.type_id);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                })
            });

        });
    </script>

@endsection