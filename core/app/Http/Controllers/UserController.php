<?php

namespace App\Http\Controllers;

use App\AdminBalance;
use App\BasicSetting;
use App\Deposit;
use App\Fund;
use App\FundLog;
use App\GeneralSetting;
use App\ManualBank;
use App\ManualFund;
use App\ManualFundLog;
use App\Payment;
use App\Photo;
use App\Plan;
use App\RebeatLog;
use App\Reference;
use App\Repeat;
use App\User;
use App\UserBalance;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use League\Flysystem\Exception;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getDashboard()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Investment Statement";
        $data['member'] = User::findOrFail(Auth::user()->id);
        $mem = User::findOrFail(Auth::user()->id);
        $data['last_deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->take(9)->get();
        $data['total_reference_user'] = User::whereUnder_reference($mem->reference)->count();
        $data['total_deposit'] = Deposit::whereUser_id(Auth::user()->id)->sum('amount');
        /*$data['total_deposit1'] = Deposit::whereUser_id(Auth::user()->id)->sum('amount');
        $data['total_deposit2'] = ManualFund::whereUser_id(Auth::user()->id)->sum('amount');*/
        $data['total_deposit_time'] = Deposit::whereUser_id(Auth::user()->id)->count();
        $data['total_deposit_pending'] = Repeat::whereUser_id(Auth::user()->id)->whereStatus(0)->count();
        $data['total_deposit_complete'] = Repeat::whereUser_id(Auth::user()->id)->whereStatus(1)->count();
        $data['total_rebeat'] = RebeatLog::whereUser_id(Auth::user()->id)->sum('balance');
        $data['total_reference'] = Reference::whereUser_id(Auth::user()->id)->sum('balance');
        $data['total_withdraw_time'] = Withdraw::whereUser_id(Auth::user()->id)->count();
        $data['total_withdraw_pending'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(0)->count();
        $data['total_withdraw_complete'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->count();
        $data['total_withdraw_refund'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(2)->count();
        $data['total_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        $freqid = Auth::user()->id;
        $month = date('m');
        $year = date('Y');

        $cnt = DB::select("select * from statement where user_id = ? AND month = ? AND year = ?", [$freqid, $month, $year]);

        if (!empty($cnt)) {

            foreach ($cnt as $cn) {
                $data['Initial'] = $cn->Added_Fund;
                $data['Opening_Balance'] = $cn->Opening_Balance;
                $data['Less_Payout']  = $cn->Withdrawal;
                $data['Nett_Balance']   = $cn->Net_Balance;
                $data['Growth_Amount']  = $cn->Growth_Amount;
                $data['Percentage_Growth']  = $cn->Percentage_Growth;
                $data['Gross']  = $cn->Gross;
                $data['CommissionAmount']  = $cn->Commission_Amount;
                $data['Closing_Balance']  = $cn->Closing_Balance;
                $data['Available_Payout']  = $cn->Payout;

            }

        }
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);

        return view('user.dashboard',$data);
    }
    public function addFund()
    {
        
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Add Fund";
        $data['payment'] = Payment::first();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.fund-add',$data);
    }
    public function historyFund()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['page_title'] = "User Add Funding History";
        $user_id = Auth::user()->id;
        $data['fund'] = Fund::whereUser_id($user_id)->orderBy('id','DESC')->get();
        $data['basic'] = BasicSetting::first();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.fund-history',$data);
    }
    public function newDeposit()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User New Invest";
        $data['payment'] = Payment::first();
        $data['plan'] = Plan::whereStatus(1)->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.deposit-new',$data);
    }
    public function postDeposit(Request $request)
    {
    
        
        $this->validate($request,[
            'id' => 'required'
        ]);
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Invest Preview";
        $data['payment'] = Payment::first();
        $data['plan'] = Plan::findOrFail($request->id);
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.deposit-preview',$data);

    }
    public function amountDeposit(Request $request)
    {
        $plan = Plan::findOrFail($request->plan);
        $user = User::findOrFail(Auth::user()->id);
        $amount = $request->amount;

        if ($request->amount > $user->amount){
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Your Current Amount.</div>
            </div>
            <div class="col-sm-7 col-sm-offset-4">
                <button type="button" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button disabled"
                        >
                    <i class="fa fa-send"></i> Deposit Amount Under This Package
                </button>
            </div>';
        }
        if( $plan->minimum > $amount){
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Plan Minimum Amount.</div>
            </div>
            <div class="col-sm-7 col-sm-offset-4">
                <button type="button" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button disabled"
                        >
                    <i class="fa fa-send"></i> Deposit Amount Under This Package
                </button>
            </div>';
        }elseif( $plan->maximum < $amount){
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Plan Maximum Amount.</div>
            </div>
            <div class="col-sm-7 col-sm-offset-4">
                <button type="button" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button disabled"
                      >
                    <i class="fa fa-send"></i> Deposit Amount Under This Package
                </button>
            </div>';
        }else{
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Deposit This Amount Under this Package.</div>
            </div>
            <div class="col-sm-7 col-sm-offset-4">
                <button type="button" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button"
                        data-toggle="modal" data-target="#DelModal"
                        data-id='.$amount.'>
                    <i class="fa fa-send"></i> Deposit Amount Under This Package
                </button>
            </div>';
        }

    }
    public function paypalCheck(Request $request)
    {
        $amount = $request->amount;
        $type = $request->payment_type;
        $basic = Payment::first();
        if ($type == 1)
        {

            if(($amount) < $basic->paypal_min){
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }elseif(($amount) > $basic->paypal_max)
            {
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }else{
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-check"></i> Well Done. Add Fund This Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }
        }elseif($type == 2){
            if(($amount) < $basic->perfect_min){
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }elseif(($amount) > $basic->perfect_max)
            {
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }else{
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-check"></i> Well Done. Add Fund This Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }
        }elseif($type == 3){
            if(($amount) < $basic->btc_min){
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }elseif(($amount) > $basic->btc_max)
            {
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }else{
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-check"></i> Well Done. Add Fund This Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }
        }elseif($type == 4){
            if(($amount) < $basic->stripe_min){
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }elseif(($amount) > $basic->stripe_max)
            {
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }else{
                return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-check"></i> Well Done. Add Fund This Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Add Fund</button>
                </div>';
            }
        }
    }
    public function storeFund(Request $request)
    {
        
        $this->validate($request,[
           'amount' => 'required',
            'payment_type' => 'required',
            'rate' => 'required'
        ]);
        $fu = Input::except('_method','_token');
        $fu['transaction_id'] = date('ymd').Str::random(6).rand(11,99);
        $fu['user_id'] = Auth::user()->id;
        $fund = FundLog::create($fu);
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Add Fund Preview";
        $data['payment'] = Payment::first();
        $data['fund'] = $fund;
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.fund-preview',$data);
    }
    public function stripePreview(Request $request)
    {
        $data['amount'] = $request->amount;
        $data['fund_id'] = $request->id;
        $data['charge'] = $request->charge;
        $data['transaction_id'] = $request->transaction;
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Card Preview";
        $data['payment_type'] = 4;
        $data['payment'] = Payment::first();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.stripe-preview',$data);
    }
    public function submitStripe(Request $request)
    {
        
        $this->validate($request,[
           'amount' => 'required',
            'cardNumber' => 'required',
            'cardExpiryMonth' => 'required',
            'cardExpiryYear' => 'required',
            'cardCVC' => 'required',
        ]);

        $amm = $request->charge;
        $cc = $request->cardNumber;
        $emo = $request->cardExpiryMonth;
        $eyr = $request->cardExpiryYear;
        $cvc = $request->cardCVC;
        $basic = Payment::first();
        Stripe::setApiKey($basic->stripe_secret);
        try{
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $emo,
                    "exp_year" => $eyr,
                    "cvc" => "$cvc"
                )
            ));


                $charge = Charge::create(array(
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => round($request->amount,2) * 100,
                    'description' => 'item',
                ));

                if ($charge['status'] == 'succeeded') {

                    $funlog = FundLog::whereTransaction_id($request->transaction_id)->first();
                    $basic = Payment::first();
                    $user = User::findOrFail($funlog->user_id);

                $basic = BasicSetting::first();
                // Fun Log
                $fu['user_id'] = $user->id;
                $fu['payment_type'] = 4;
                $fu['transaction_id'] = $funlog->transaction_id;
                $fu['amount'] = $funlog->amount;
                $fu['rate'] = $funlog->rate;
                $fu['charge'] = $amm;
                $fu['total'] = $request->amount;
                Fund::create($fu);

                // user Log
                $us['user_id'] = $user->id;
                $us['balance_type'] = 1;
                $us['details'] = "Fund Add By Credit Card. Transaction #ID ".$funlog->transaction_id;
                $us['balance'] = $funlog->amount;
                $us['charge'] = $amm;
                $us['old_balance'] = $user->amount;
                $us['new_balance'] = $user->amount + $funlog->amount;
                UserBalance::create($us);
                $user->amount = $us['new_balance'];
                $user->save();

                // Admin log
                $ad['user_id'] = $user->id;
                $ad['balance_type'] = 1;
                $ad['details'] = "Fund Deposit By Credit Card. Transaction #ID ".$funlog->transaction_id;
                $ad['balance'] = $funlog->amount;
                $ad['charge'] = $amm;
                $ad['old_balance'] = $basic->admin_total;
                $ad['new_balance'] = $amm + $basic->admin_total + $funlog->amount;
                AdminBalance::create($ad);
                $basic->admin_total = $ad['new_balance'];
                $basic->save();

                    session()->flash('message','Successfully Card Charged.');
                    session()->flash('title','Success');
                    session()->flash('type','success');

                return redirect()->route('add-fund');
                }else{
                    session()->flash('message','Something Is Wrong.');
                    session()->flash('title','Opps..');
                    session()->flash('type','warning');
                    return redirect()->route('add-fund');
                }

        }catch (Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('title','Opps..');
            session()->flash('type','warning');
            return redirect()->route('add-fund');
        }
    }
    public function btcPreview(Request $request)
    {
        $data['amount'] = $request->amount;
        $data['charge'] = $request->charge;
        $data['transaction_id'] = $request->transaction_id;
        $pay = Payment::first();
        $tran = FundLog::whereTransaction_id($data['transaction_id'])->first();

        $blockchain_root = "https://blockchain.info/";
        $blockchain_receive_root = "https://api.blockchain.info/";
        $mysite_root = url('/');
        $secret = "ABIR";
        $my_xpub = $pay->btc_xpub;
        $my_api_key = $pay->btc_api;

        $invoice_id = $tran->transaction_id;

        $callback_url = route('btc_ipn',['invoice_id'=>$invoice_id,'secret'=>$secret]);



        if ($tran->btc_acc == null){

                $resp = file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . '&callback=' . urlencode($callback_url) . '&xpub=' . $my_xpub);

                $response = json_decode($resp);

                $sendto = $response->address;

            if ($sendto!="") {
                $api = "https://blockchain.info/tobtc?currency=USD&value=".$data['amount'];
                $usd = file_get_contents($api);
                $tran->btc_amo = $usd;
                $tran->btc_acc = $sendto;
                $tran->save();
            }else{
                session()->flash('message', "SOME ISSUE WITH API");
                Session::flash('type', 'warning');
                return redirect()->back();
            }
        }else{
            $usd = $tran->btc_amo;
            $sendto = $tran->btc_acc;
        }
        /*$sendto = "1HoPiJqnHoqwM8NthJu86hhADR5oWN8qG7";
        $usd =100;*/

        /*if ($tran->btc_acc == null){

            if (file_exists($blockchain_receive_root . "v2/receive?key=" . $my_api_key . '&callback=' . urlencode($callback_url) . '&xpub=' . $my_xpub)) {
                $resp = file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . '&callback=' . urlencode($callback_url) . '&xpub=' . $my_xpub);

                $response = json_decode($resp);

                $sendto = $response->address;

                $api = "https://blockchain.info/tobtc?currency=USD&value=".$data['amount'];

                $usd = file_get_contents($api);

                $tran->btc_amo = $usd;
                $tran->btc_acc = $sendto;
                $tran->save();
            }else{
                session()->flash('message', 'BlockChain API or XPUB not Correct.');
                Session::flash('type', 'warning');
                Session::flash('title', 'Opps');
                return redirect()->back();
            }
        }else{
            $usd = $tran->btc_amo;
            $sendto = $tran->btc_acc;
        }*/
        /*$sendto = "1HoPiJqnHoqwM8NthJu86hhADR5oWN8qG7";
        $usd =100;*/
        $var = "bitcoin:$sendto?amount=$usd";
        $data['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "BTC Send Preview";
        $data['payment_type'] = 3;
        $data['payment'] = Payment::first();
        $data['btc'] = $usd;
        $data['add'] = $sendto;
        $data['fund'] = $tran;
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.btc-send',$data);
    }
    public function depositSubmit(Request $request)
    {
        
        $this->validate($request,[
           'id' => 'required',
            'user_id' => 'required',
            'plan_id' => 'required'
        ]);
        $plan = Plan::findOrFail($request->plan_id);
        $user = User::findOrFail($request->user_id);
        $basic = BasicSetting::first();
        $dep['amount'] = $request->id;
        $dep['percent'] = $plan->percent;
        $dep['time'] = $plan->time;
        $dep['compound_id'] = $plan->compound_id;
        $dep['user_id'] = $user->id;
        $dep['plan_id'] = $plan->id;
        $dep['status'] = 1;
        $dep['deposit_number'] = date('ymd').Str::random(6).rand(11,99);
        $us['user_id'] = $user->id;
        $us['balance_type'] = 2;
        $us['balance'] = $request->id;
        $us['old_balance'] = $user->amount;
        $user->amount = $user->amount - $request->id;
        $us['new_balance'] = $user->amount;
        $user->save();
        $deposit = Deposit::create($dep);
        $us['details'] = "Invest ID: # ".$dep['deposit_number'].'; '."Invest Plan : ".$plan->name;
        UserBalance::create($us);
        $rr['user_id'] = $user->id;
        $rr['deposit_id'] = $deposit->id;
        $rr['repeat_time'] = Carbon::parse()->addHours($plan->compound->compound);
        $refer = Auth::user()->under_reference;
        if($basic->reference_id == $refer){
            $ref['user_id'] = 0;
            $ref['reference_id'] = $basic->reference_id;
            $ref['under_reference'] = $user->reference;
            $ref['balance'] = ( $request->id * $basic->reference ) / 100;
            $ref['details'] = "Referral Invest Bonus : ".$ref['balance']."; ".$basic->currency.' Referral ID : # '.$ref['under_reference'];
            $ref['old_balance'] = $basic->admin_total;
            $ref['new_balance'] = $basic->admin_total;
            Reference::create($ref);

            //admin reference Log
            $ad['user_id'] = 0;
            $ad['balance_type'] = 5;
            $ad['balance'] = $ref['balance'];
            $ad['old_balance'] = $ref['old_balance'];
            $ad['new_balance'] = $ref['old_balance'];
            $ad['details'] = $ref['details'];
            $ad['charge'] = "Default";
            AdminBalance::create($ad);

            //admin balance log

            $ad['user_id'] = Auth::user()->id;
            $ad['balance_type'] = 2;
            $ad['balance'] = $request->id;
            $ad['old_balance'] = $basic->admin_total;
            $ad['new_balance'] = $basic->admin_total + $request->id;
            $ad['details'] = "Invest ID: # ".$dep['deposit_number'].'; '."Invest Plan : ".$plan->name;
            AdminBalance::create($ad);
            $basic->admin_total = $ad['new_balance'];
            $basic->save();

        }else{
            /* ---------- Reference Log ---------*/
            $rrrr = User::whereReference(Auth::user()->under_reference)->first();
            $ref['user_id'] = $rrrr->id;
            $ref['reference_id'] = $rrrr->reference;
            $ref['under_reference'] = $user->reference;
            $ref['balance'] = ( $request->id * $basic->reference ) / 100;
            $ref['details'] = "Referral Invest Bonus : ".$ref['balance']."-".$basic->currency."; ".' Referral ID : # '.$ref['under_reference'];
            $ref['old_balance'] = $rrrr->amount;
            $ref['new_balance'] = $rrrr->amount + $ref['balance'];
            Reference::create($ref);

            /*---- User reference Log ----*/
            $ad1['user_id'] = $rrrr->id;
            $ad1['balance_type'] = 5;
            $ad1['balance'] = $ref['balance'];
            $ad1['old_balance'] = $rrrr->amount;
            $ad1['new_balance'] = $rrrr->amount + $ad1['balance'];
            $ad1['details'] = $ref['details'];
            UserBalance::create($ad1);

            $rrrr->amount = $ref['new_balance'];
            $rrrr->save();

            /* ------ Admin reference Log -------*/
            $ad['user_id'] = $rrrr->id;
            $ad['balance_type'] = 5;
            $ad['balance'] = $ref['balance'];
            $ad['old_balance'] = $basic->admin_total;
            $ad['new_balance'] = $basic->admin_total - $ad['balance'];
            $ad['details'] = $ref['details'];
            AdminBalance::create($ad);
            $basic->admin_total = $ad['new_balance'];
            $basic->save();

            $ad1['user_id'] = Auth::user()->id;
            $ad1['balance_type'] = 2;
            $ad1['balance'] = $request->id;
            $ad1['old_balance'] = $basic->admin_total;
            $ad1['new_balance'] = $basic->admin_total + $request->id;
            $ad1['details'] = "Invest ID: # ".$dep['deposit_number'].'; '."Invest Plan : ".$plan->name;
            AdminBalance::create($ad1);
            $basic->admin_total = $ad1['new_balance'];
            $basic->save();
        }

        session()->flash('message', 'Deposit Completed Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('manual-payment-request');
        /*return redirect()->back();*/
    }
    public function depositHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Deposit History";
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.deposit-history',$data);
    }
    public function repeatHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Profit History";
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->paginate(9);
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.repeat-history',$data);
    }
    public function repeatTable($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Profit Table";
        $data['repeat'] = RebeatLog::whereDeposit_id($id)->whereUser_id(Auth::user()->id)->orderBy('id','ASC')->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.repeat-table',$data);
    }
    public function referenceUser()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Reference User";
        $data['user'] = User::whereUnder_reference(Auth::user()->reference)->orderBy('id','desc')->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.reference-user',$data);
    }
    public function referenceHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Reference Bonus History";
        $data['bonus'] = Reference::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.reference-history',$data);
    }
    
	
	public function addProfile(Request $request)
    {
        /*dd($request);*/
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'zip' => 'required',
            'ID_Number' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
        ]);
        $us = Input::except('_method','_token','email');
        $password = Hash::make('123456');
        $us->password = $password;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(450,600)->save($location);
            $us['image'] = $filename;
        }
        //$user = User::findOrFail($id);
        $us->save();
        session()->flash('message', 'User Added Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('user-dashboard');

    }

    public function userActivity()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User All Activity";
        $data['activity'] = UserBalance::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.user-activity',$data);
    }
    public function editUser()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Details Update ";
        $data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
		
        return view('user.user-edit',$data);
    }
    public function updateUser(Request $request,$id)
    {
        
        /*dd($request);*/
        $this->validate($request,[
           'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'zip' => 'required',
            'ID_Number' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
        ]);
        $us = Input::except('_method','_token','email');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(450,600)->save($location);
            $us['image'] = $filename;
        }
        $user = User::findOrFail($id);
        $user->fill($us)->save();
        session()->flash('message', 'User Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('user-dashboard');
    }
    public function userPassword()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Password Update ";
		$data['page_title'] = "User Password Updat ";
        $data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
		
        return view('user.user-password',$data);
    }
    public function updatePassword(Request $request,$id)
    {
        
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:6|confirmed'
        ]);
        try {
            $c_password = Auth::user()->password;
            $user = User::findOrFail($id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                Session::flash('type', 'success');
                Session::flash('title', 'Success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Password Not Match');
                Session::flash('type', 'warning');
                Session::flash('title', 'Opps..!');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'warning');
            return redirect()->back();
        }
    }
    public function autoDeposit(Request $request)
    {
        
        $amount = $request->amount;
        $plan_id = $request->plan_id;
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Deposit Preview";
        $data['payment'] = Payment::first();
        $data['plan'] = Plan::findOrFail($plan_id);
        $data['amount'] = $amount;
        if (Auth::user()->amount < $amount){
            $data['hit'] = 1;
        }else{
            $data['hit'] = 0;
        }
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('user.deposit-auto-preview',$data);
    }

    public function manualFundAdd()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Fund Add via Bank";
        $data['bank'] = ManualBank::whereStatus(1)->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('bank.manual-fund',$data);
    }
    public function fundAddCheck(Request $request)
    {

        $amount = $request->amount;
        $method = $request->method_id;
        $bank = ManualBank::findOrFail($method);

        if ($request->amount < $bank->minimum or $request->amount > $bank->maximum){
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> You can not add this Amount</div>
            </div>
            <div class="col-sm-7 col-sm-offset-4">
                <button type="button" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button disabled"
                        >
                    <i class="fa fa-send"></i> Add Fund
                </button>
            </div>';
        }
        else{
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. You Can add This Deposit.</div>
            </div>
            <div class="col-sm-7 col-sm-offset-4">
                <button type="submit" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button"
                        data-toggle="modal" data-target="#DelModal"
                        data-id='.$amount.'>
                    <i class="fa fa-send"></i> Add Fund
                </button>
            </div>';
        }
    }
    public function StoreManualFundAdd(Request $request)
    {
        $mu['amount'] = $request->amount;
        $mu['bank_id'] = $request->method_id;
        $mu['user_id'] = Auth::user()->id;
        $mu['transaction_id'] = date('ymd').Str::random(6).rand(11,99);
        $bank = ManualBank::findOrFail($request->method_id);
        $mu['charge'] = $bank->fix + (($request->amount * $bank->percent ) / 100);
        $mu['total'] = $request->amount + $mu['charge'];
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Bank Deposits Preview";
        $data['fund'] = ManualFundLog::create($mu);
        $data['method'] = $bank;
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('bank.manual-fund-preview',$data);
    }
    public function submitManualFund(Request $request)
    {
        
        $mu['manual_fund_log_id'] = $request->log_id;
        $mu['message'] = $request->message;
        $am = ManualFundLog::findOrFail($request->log_id);
        $mu['amount'] = $am->amount;
        $mu['user_id'] = Auth::user()->id;
        $ad = ManualFund::create($mu);
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            foreach ($image3 as $i)
            {
                $filename3 = time().uniqid().'.'.$i->getClientOriginalExtension();
                $location = 'assets/upload/' . $filename3;
                Image::make($i)->save($location);
                $image['image'] = $filename3;
                $image['fund_id'] = $ad->id;
                Photo::create($image);
            }
        }
        session()->flash('message', 'Request Successfully Completed.');
        Session::flash('title', 'Success');
        Session::flash('type', 'success');
        return redirect()->back();

    }
    public function manualFundHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Bank Fund Add History";
        $data['fund'] = ManualFund::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('bank.manual-fund-history',$data);
    }
    public function manualFundAddDetails($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Bank Payment Request";
        $data['fund'] = ManualFund::findOrFail($id);
        $data['img'] = Photo::whereFund_id($id)->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('bank.manual-payment-request-view',$data);
    }
	
	
	
	
	
   // Inside User Controller
	public function user_switch_start( $new_user )
	{
	  $new_user = User::find( $new_user );
	  Session::put( 'orig_user', Auth::id() );
	  Auth::login( $new_user );
	  return redirect()->back();
	}

	public function user_switch_stop()
	{
	  $id = Session::pull( 'orig_user' );
	  $orig_user = User::find( $id );
	  Auth::login( $orig_user );
	  return redirect()->back();
	}
}
