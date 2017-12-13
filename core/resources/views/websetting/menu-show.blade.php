@extends('layouts.dashboard')
@section('title', 'Menu Show')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-body form">

                    <div class="row">
                        @foreach($menu as $m)
                        <div class="col-md-6">
                            <div class="text-center"><b>{{ $m->name }}</b></div>
                            <br>
                            <p class="text-center">
                                {!! $m->description !!}
                            </p>
                            <div class="col-md-6">
                                <a href="{{ route('menu-edit',$m->id) }}" class="btn btn-primary btn-block margin-top-20"><i class="fa fa-edit"></i> Edit Menu </a>
                            </div>
                            {{ Form::open(['route'=>['menu-delete',$m->id],'method'=>'DELETE']) }}
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger btn-block margin-top-20" onclick="return confirm('Are You Sure..!')"><i class="fa fa-trash"></i> Delete Menu </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div><!---ROW-->


@endsection
