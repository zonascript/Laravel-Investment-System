@extends('layouts.dashboard')
@section('content')




    <div class="panel panel-success" data-collapsed="0">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title"><strong><i class="fa fa-line-chart"></i> Admin Balance Statistics</strong></div>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>

        <!-- panel body -->
        <div class="panel-body">

            <div class="col-sm-4 col-xs-6">
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <div class="num" data-start="0" data-end="{{ $current_balance }}" data-prefix="{{ $basic->symbol }} " data-duration="1500" data-delay="0">0</div>

                    <h3>Current Balance</h3>
                </div>

            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="tile-stats tile-blue">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-cloud-download"></i></div>
                    <div class="num" data-start="0" data-end="{{ $total_deposit }}" data-postfix=" - {{ $basic->currency }}" data-duration="1500" data-delay="0">0</div>

                    <h3>Total Deposit</h3>
                </div>

            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="tile-stats tile-red">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-cloud-upload"></i></div>
                    <div class="num" data-start="0" data-end="{{ $total_withdraw_bal }}" data-postfix=" - {{ $basic->currency }}" data-duration="1500" data-delay="0">0</div>

                    <h3>Total Withdraw</h3>
                </div>

            </div>

        </div>

    </div>

    <div class="panel panel-info" data-collapsed="0">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title"><strong><i class="fa fa-users"></i> User Statistics</strong></div>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>

        <!-- panel body -->
        <div class="panel-body">

            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-green">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-users"></i></div>
                    <div class="num" data-start="0" data-end="{{ $total_user }}" data-postfix=" - User" data-duration="1500" data-delay="0">0</div>

                    <h3>Registered User</h3>
                </div>

            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-blue">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-user"></i></div>
                    <div class="num" data-start="0" data-end="{{ $total_active }}" data-postfix=" - User" data-duration="1500" data-delay="0">0</div>
                    <h3>Active User</h3>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-red">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-warning"></i></div>
                    <div class="num" data-start="0" data-end="{{ $total_unverify }}" data-postfix=" - User" data-duration="1500" data-delay="0">0</div>
                    <h3>Unverified User</h3>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-red">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-user-times"></i></div>
                    <div class="num" data-start="0" data-end="{{ $total_block }}" data-postfix=" - User" data-duration="1500" data-delay="0">0</div>

                    <h3>Block User</h3>
                </div>

            </div>

        </div>

    </div>


    <div class="panel panel-danger" data-collapsed="0">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title"><strong><i class="fa fa-random"></i> Withdraw Method</strong></div>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>

        <!-- panel body -->
        <div class="panel-body">

            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-green">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-list"></i></div>
                    <div class="num" data-start="0" data-end="{{ $withdraw_total }}" data-postfix="" data-duration="1500" data-delay="0">0</div>

                    <h3>Total Withdraw</h3>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-blue">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-spinner"></i></div>
                    <div class="num" data-start="0" data-end="{{ $withdraw_pending }}" data-postfix="" data-duration="1500" data-delay="0">0</div>
                    <h3>Pending Withdraw</h3>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-red">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-recycle"></i></div>
                    <div class="num" data-start="0" data-end="{{ $withdraw_refund }}" data-postfix="" data-duration="1500" data-delay="0">0</div>
                    <h3>Refund Withdraw</h3>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-green">
                    <div style="bottom: 40px;" class="icon"><i class="fa fa-check"></i></div>
                    <div class="num" data-start="0" data-end="{{ $withdraw_success }}" data-postfix="" data-duration="1500" data-delay="0">0</div>
                    <h3>Success Withdraw</h3>
                </div>
            </div>

        </div>
    </div>

@endsection