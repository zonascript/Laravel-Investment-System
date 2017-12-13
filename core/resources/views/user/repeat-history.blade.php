@extends('layouts.user')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="fa fa-send"></i> <strong>{{ $page_title }}</strong></div>

                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <div class="row">
                        @php $i = 0 @endphp
                        @foreach($deposit as $p)
                            @php $i++ @endphp

                            <div class="col-sm-4 text-center">
                                <div class="panel panel-{{ $p->status == 1 ? 'success' : 'info' }} panel-pricing">
                                    <div class="panel-heading">
                                        <h3 style="font-size: 28px;"><b>{{ $p->plan->name }}</b></h3>
                                    </div>
                                    <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                        <p><strong>Invest - {{ $p->amount }} {{ $basic->currency }}</strong></p>
                                    </div>
                                    <ul style='font-size: 15px;' class="list-group text-center bold">
                                        <li class="list-group-item"><i class="fa fa-check"></i> Commission - {{ $p->percent }} <i class="fa fa-percent"></i> </li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Repeat - {{ $p->time }} times </li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Complete - @php $rep = \App\Repeat::whereDeposit_id($p->id)->first() @endphp{{ $rep->rebeat }} times </li>
                                        <li class="list-group-item"><i class="fa fa-check"></i> Compound - <span class="aaaa">{{ $p->compound->name }}</span></li>
                                    </ul>
                                    <div class="row">
                                        <hr>
                                        @php $wid = (100*$rep->rebeat) /$p->time  @endphp
                                        <div class="col-xs-12 col-sm-10 col-sm-offset-1 progress-container">
                                            @if($wid == 0)
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <span style="color: green"><strong>Not Start Yet.</strong></span>
                                                    </div>
                                                </div>
                                            @else
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar bar{{ $i }} progress-bar-success" style="width:0%"><span>{{ round($wid) }}% Complete</span></div>
                                            </div>
                                            @endif
                                        </div>
                                        <script>
                                            $('.bar{{ $i }}').animate({
                                                width: '{{ $wid }}%'
                                            }, 2500);
                                        </script>
                                    </div>
                                    <div class="panel-footer" style="overflow: hidden">
                                        <div class="col-sm-12">
                                            <a href="{{ route('repeat-table',$p->id) }}" class="btn btn-info btn-block btn-icon icon-left">
                                                <i class="fa fa-mail-forward"></i> View Rebeating Table
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="text-center">
                        {{ $deposit->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div><!---ROW-->

@endsection
@section('scripts')



@endsection

