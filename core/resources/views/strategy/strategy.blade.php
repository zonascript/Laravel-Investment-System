
@extends('layouts.dashboard')
@section('content')

    <div class="col-md-12" >
        <button style="margin-bottom: 20px;" type="button" class="btn btn-danger btn-sm btn-icon icon-left delete_button"
                data-toggle="modal" data-target="#DelModal" >
            <i class="fa fa-plus"></i> Add New Strategy
        </button>
        {{--<button id="btn-add" name="btn-add" style="margin-bottom: 20px;" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Strategy</button>--}}
    </div>
    <table class="table table-striped table-hover table-bordered datatable" id="table-4">
        <thead>
        <tr>
            <th>No</th>
            <th>Strategy Title</th>
            <th>Strategy Image</th>
            <th>Strategy Description</th>
            <th>Documentation</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=0; ?>
        @foreach ($category as $cat)
            <?php $no++; ?>
            <tr id="task{{$cat->id}}">
                <td>{{$no}}</td>
                <td>{{ $cat->title }}</td>
                <td><img src="{{ asset('assets/images') }}/{{ $cat->image }}" alt=""></td>
                <td>{{ $cat->description }}</td>
                <td>
                    <a href="{{ route('strategy-edit',$cat->id) }}" class="btn btn-info btn-sm btn-detail btn-icon icon-left"><i class="fa fa-edit"></i> Edit Strategy</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <div class="text-right">
        {{ $category->links() }}
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-plus'></i> Create New Strategy</h4>
                </div>

                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ route('manage-strategy') }}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Strategy Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="title" name="title" required placeholder="Strategy title" value="">
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Strategy Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control has-error" id="image" name="image" value="" required>
                                <span style="color: red;margin-top: 5px;">PNG Image Recommended. Size 112 X 104 </span>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputTask" class="col-sm-3 control-label">Strategy Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" cols="30" rows="5"
                                          class="form-control" required></textarea>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group error">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-check"></i> Create</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection