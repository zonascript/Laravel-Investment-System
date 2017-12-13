<?php

namespace App\Http\Controllers;

use App\AdminBalance;
use App\BasicSetting;
use App\GeneralSetting;
use App\ManualPayment;
use App\Plan;
use App\User;
use App\UserBalance;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Advert;
use App\Currency;
use App\Location;

use App\Member;
use App\Report;
use App\SaveAd;
use App\SubCategory;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function newWithdraw()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Method";
        $data['method'] = ManualPayment::whereStatus(1)->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('withdraw.withdraw-new',$data);
    }
    public function checkAmount(Request $request)
    {
        $amount = $request->amount;
        $met = $request->method_id;
        $method = ManualPayment::findOrFail($met);
        $charge = $method->method_fix + (($amount * $method->method_percent) /100);
        $hit = $charge + $amount;
        $user = Auth::user()->amount;

        if ($hit > $user){
            return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Your Request Balance Larger Then Current balance. Contact Administrator for Help</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Withdraw Now</button>
                </div>';
        }
        if($amount < $method->method_min){
            return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Withdraw Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Withdraw Now</button>
                </div>';
        }elseif ($amount > $method->method_max)
        {
            return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Withdraw Minimum Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Withdraw Now</button>
                </div>';
        }else{
            return '<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. You can Withdraw This Amount.</div>
                </div>
                <div class="col-sm-9 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Withdraw Now</button>
                </div>';
        }

    }
    public function postWithdraw(Request $request)
    {
       
        $this->validate($request,[
           'amount' => 'required',
            'method_id' => 'required'
        ]);
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Preview";
        $data['method'] = ManualPayment::findOrFail($request->method_id);
        $data['amount'] = $request->amount;
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('withdraw.withdraw-preview',$data);
    }
    public function submitWithdraw(Request $request)
    {
        
        $this->validate($request,[
           'amount' => 'required',
            'method_id' => 'required',
            'acc_name' => 'required',
            'acc_number' => 'required',
            'acc_code' => 'required'
        ]);
        $amount = $request->amount;
        $met = $request->method_id;
        $method = ManualPayment::findOrFail($met);
        $charge = $method->method_fix + (($amount * $method->method_percent) /100);
        $hit = $charge + $amount;
        $user = Auth::user()->amount;
        $uuuu = User::findOrFail(Auth::user()->id);
        if ($hit > $user){
            session()->flash('message', 'Your Request Balance Larger Then Current balance.');
            Session::flash('type', 'warning');
            Session::flash('title', 'Opps.!');
            return redirect()->back();
        }
        if($amount < $method->method_min){
            session()->flash('message', 'Amount Is Smaller than Withdraw Minimum Amount.');
            Session::flash('type', 'warning');
            Session::flash('title', 'Opps.!');
            return redirect()->back();
        }elseif ($amount > $method->method_max){
            session()->flash('message', 'Amount Is Larger than Withdraw Minimum Amount.');
            Session::flash('type', 'warning');
            Session::flash('title', 'Opps.!');
            return redirect()->back();
        }else{
            $basic = BasicSetting::first();
            $wid['user_id'] = Auth::user()->id;
            $wid['method_id'] = $met;
            $wid['amount'] = $amount;
            $wid['withdraw_number'] = date('ymd').Str::random(6).rand(11,99);
            $wid['charge'] = $charge;
            $wid['total'] = $hit;
            $wid['new_balance'] = Auth::user()->amount - $hit;
            $wid['old_balance'] = Auth::user()->amount;
            $wid['message'] = $request->message;
            $wid['acc_name'] = $request->acc_name;
            $wid['acc_number'] = $request->acc_number;
            $wid['acc_code'] = $request->acc_code;
            $withdraw = Withdraw::create($wid);
            $us['user_id'] = Auth::user()->id;
            $us['balance_type'] = 4;
            $us['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Withdraw By : ".$withdraw->withdrawMethod->title;
            $us['balance'] = $amount;
            $us['charge'] = $charge;
            $us['old_balance'] = Auth::user()->amount;
            $us['new_balance'] = Auth::user()->amount - ($amount + $charge);
            UserBalance::create($us);
            $ad['user_id'] = Auth::user()->id;
            $ad['balance_type'] = 4;
            $ad['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Withdraw By : ".$withdraw->withdrawMethod->title;
            $ad['balance'] = $amount;
            $ad['charge'] = $charge;
            $ad['old_balance'] = $basic->admin_total;
            $ad['new_balance'] = $basic->admin_total + ($amount + $charge);
            $basic->admin_total = $ad['new_balance'];
            AdminBalance::create($ad);
            $basic->save();
            $uuuu->amount = $us['new_balance'];
            $uuuu->save();
            session()->flash('message', 'Withdraw Request Successfully Competed.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }
    }
    public function withdrawHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw History";
        $data['withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->get();
		
		$data['member'] = User::findOrFail(Auth::user()->id);
		
		$data['namew'] = $data['member']-> ID_Number;
		$data['withdrawalcnt'] = '';
		
		$data['withdrawalcnt'] = DB::select("select * from users where ID_Number = ?", [ $data['namew'] ]);
        return view('withdraw.withdraw-history',$data);
    }




}
