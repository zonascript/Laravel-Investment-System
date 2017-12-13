<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminBalance;
use App\Advert;
use App\BasicSetting;
use App\Category;
use App\Chose;
use App\Compound;
use App\Currency;
use App\Deposit;
use App\Fund;
use App\GeneralSetting;
use App\Letter;
use App\Location;
use App\Mail\NewsLetter;
use App\ManualFund;
use App\ManualPayment;
use App\Member;
use App\News;
use App\Partner;
use App\Payment;
use App\Photo;
use App\Plan;
use App\Promo;
use App\RebeatLog;
use App\Reference;
use App\Report;
use App\SaveAd;
use App\Slider;
use App\Strategy;
use App\SubCategory;
use App\Testimonial;
use App\User;
use App\UserBalance;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function __construct()
    {
        $data = [];
        $data['general'] = GeneralSetting::first();
        $this->middleware('auth:admin');
        $general_all = GeneralSetting::first();
        $this->site_title = $general_all->title;
        $this->gen_phone = $general_all->number;
        $this->gen_email = $general_all->email;
        $this->site_color = $general_all->color;
    }


    public function getDashboard()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Dashboard";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $basic = Payment::first();
        $data['current_balance'] = $data['basic']->admin_total;
        $data['total_deposit'] = Deposit::sum('amount');
        $data['total_withdraw_bal'] = Withdraw::sum('amount');
        $data['total_user'] = User::all()->count();
        $data['total_active'] = User::whereStatus(1)->whereBlock_status(0)->count();
        $data['total_block'] = User::whereBlock_status(1)->count();
        $data['total_unverify'] = User::whereStatus(0)->count();
        $data['total_plan'] = Plan::all()->count();
        $data['active_plan'] = Plan::whereStatus(1)->count();
        $data['deactive_plan'] = Plan::whereStatus(0)->count();
        $pp = 1;

        $data['active_fund'] = $pp;
        $data['total_withdraw'] = ManualPayment::all()->count();
        $data['active_withdraw'] = ManualPayment::whereStatus(1)->count();
        $data['withdraw_total'] = Withdraw::all()->count();
        $data['withdraw_pending'] = Withdraw::whereStatus(0)->count();
        $data['withdraw_success'] = Withdraw::whereStatus(1)->count();
        $data['withdraw_refund'] = Withdraw::whereStatus(2)->count();
        return view('dashboard.dashboard', $data);
    }
    public function adminActivity()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Admin All Activity";
        $data['activity'] = AdminBalance::orderBy('id','desc')->get();
        return view('dashboard.admin-activity',$data);
    }
    public function editProfile()
    {
        $data['page_title'] = "Edit Profile";
        $general_all = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['site_title'] = $general_all->title;
        $data['general'] = $general_all;
        $data['admin'] = Admin::findOrFail(Auth::guard('admin')->user()->id);
        return view('dashboard.edit-profile',$data);
    }
    public function updateProfile(Request $request)
    {

        $ad = Admin::first();
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$ad->id,
            'image' => 'mimes:jpg,png,gif,jpeg'
        ]);
        $add = Input::except('_token','_method');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->save($location);
            $add['image'] = $filename;
        }
        $ad->fill($add)->save();
        session()->flash('message', 'Profile Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();

    }
    public function getChangePass()
    {
        $data['page_title'] = "Change Password";
        $general_all = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['general'] = $general_all;
        $data['site_title'] = $general_all->title;
        return view('dashboard.change-pass',$data);
    }
    public function postChangePass(Request $request)
    {

        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:6|confirmed'
        ]);

        try {
            $c_password = Auth::guard('admin')->user()->password;
            $c_id = Auth::guard('admin')->user()->id;

            $user = Admin::findOrFail($c_id);

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
    public function getManualPayment()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "Manual Payment Method";
        $data['method'] = ManualPayment::orderBy('id', 'Asc')->get();
        $data['basic'] = BasicSetting::first();
        return view('payment.manual-payment-show', $data);
    }
    public function storeManualPayment(Request $request)
    {


        $rules = array(
            'title' => 'required|unique:manual_payments,title',
            'method_time' => 'required',
            'method_fix' => 'required',
            'method_percent' => 'required',
            'method_min' => 'required',
            'method_max' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = ManualPayment::create($request->all());
            return Response::json($category);
        }
    }
    public function editManualPayment($task_id)
    {
        $category = ManualPayment::find($task_id);
        return Response::json($category);
    }
    public function updateManualPayment(Request $request,$task_id)
    {


        $cat = ManualPayment::find($task_id);
        $rules = array(
            'title' => 'required|unique:manual_payments,title,'.$cat->id,
            'method_time' => 'required',
            'method_fix' => 'required',
            'method_percent' => 'required',
            'method_min' => 'required',
            'method_max' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->title = $request->title;
            $cat->method_time = $request->method_time;
            $cat->method_fix = $request->method_fix;
            $cat->method_percent = $request->method_percent;
            $cat->method_min = $request->method_min;
            $cat->method_max = $request->method_max;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function paymentActive(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);
        $p = ManualPayment::findOrFail($request->id);
        if ($p->status == 0) {
            $p->status = 1;
            $p->save();
            session()->flash('message', 'Payment Method Activate Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }else{
            $p->status = 0;
            $p->save();
            session()->flash('message', 'Payment Method DeActivate Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }
    }
    public function getCategory()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage News Category";
        $data['category'] = Category::orderBy('id', 'DESC')->paginate(10);
        return view('news.news-category', $data);
    }

    public function storeCategory(Request $request)
    {


        $rules = array(
            'name' => 'required|unique:categories,name',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Category::create($request->all());
            return Response::json($category);
        }
    }
    public function editCategory($task_id)
    {
        $category = Category::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateCategory(Request $request,$task_id)
    {


        $cat = Category::find($task_id);
        $rules = array(
            'name' => 'required|unique:categories,name,'.$cat->id,
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->name = $request->name;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function createNews()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create New News";
        $data['category'] = Category::all();
        return view('news.news-create', $data);
    }
    public function storeNews(Request $request)
    {


        $this->validate($request,[
            'title' => 'required|unique:news,title',
            'category_id' => 'required',
            'description' => 'required'
        ]);
        News::create($request->all());
        session()->flash('message', 'News Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function showNews()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage All News";
        $data['news'] = News::orderBy('id','desc')->get();
        return view('news.news-show', $data);
    }
    public function editNews($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage All News";
        $data['news'] = News::findOrFail($id);
        $data['category'] = Category::all();
        return view('news.news-edit', $data);
    }
    public function updateNews(Request $request,$id)
    {


        $new = News::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|unique:news,title,'.$new->id,
            'category_id' => 'required',
            'description' => 'required',
        ]);
        $new->fill($request->all())->save();
        session()->flash('message', 'News Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function viewNews($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Single News View";
        $data['news'] = News::findOrFail($id);
        return view('news.news-view', $data);
    }
    public function deleteNews(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);
        News::destroy($request->id);
        session()->flash('message', 'News Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('news-show');
    }
    public function managePayment()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "Manage Payment Method";
        $data['basic'] = BasicSetting::first();
        $data['payment'] = Payment::first();
        return view('payment.payment-show', $data);
    }
    public function updateManagePayment(Request $request,$id)
    {



        $this->validate($request,[
            'paypal_name' => 'required',
            'paypal_image' => 'mimes:png',
            'paypal_rate' => 'required',
            'paypal_max' => 'required',
            'paypal_min' => 'required',
            'paypal_fix' => 'required',
            'paypal_percent' => 'required',
            'paypal_email' => 'required',
            'perfect_name' => 'required',
            'perfect_image' => 'mimes:png',
            'perfect_rate' => 'required',
            'perfect_max' => 'required',
            'perfect_min' => 'required',
            'perfect_fix' => 'required',
            'perfect_percent' => 'required',
            'perfect_account' => 'required',
            'perfect_alternate' => 'required',
            'btc_name' => 'required',
            'btc_image' => 'mimes:png',
            'btc_rate' => 'required',
            'btc_max' => 'required',
            'btc_min' => 'required',
            'btc_fix' => 'required',
            'btc_percent' => 'required',
            'btc_api' => 'required',
            'btc_xpub' => 'required',
            'stripe_name' => 'required',
            'stripe_image' => 'mimes:png',
            'stripe_rate' => 'required',
            'stripe_max' => 'required',
            'stripe_min' => 'required',
            'stripe_fix' => 'required',
            'stripe_percent' => 'required',
            'stripe_secret' => 'required',
            'stripe_publisher' => 'required',
        ]);

        $payment = Payment::findOrFail($id);
        $pay = Input::except('_method','_token');

        $pay['paypal_status'] = $request->onoffswitch2 == 'on' ? '1' : '0';
        $pay['perfect_status'] = $request->onoffswitch3 == 'on' ? '1' : '0';
        $pay['btc_status'] = $request->onoffswitch4 == 'on' ? '1' : '0';
        $pay['stripe_status'] = $request->onoffswitch5 == 'on' ? '1' : '0';

        if($request->hasFile('paypal_image')){
            $image3 = $request->file('paypal_image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $pay['paypal_image'] = $filename3;
        }
        if($request->hasFile('perfect_image')){
            $image3 = $request->file('perfect_image');
            $filename3 = time().'h2'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $pay['perfect_image'] = $filename3;
        }
        if($request->hasFile('btc_image')){
            $image3 = $request->file('btc_image');
            $filename3 = time().'h1'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $pay['btc_image'] = $filename3;
        }
        if($request->hasFile('stripe_image')){
            $image3 = $request->file('stripe_image');
            $filename3 = time().'h4'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $pay['stripe_image'] = $filename3;
        }

        $payment->fill($pay)->save();

        session()->flash('message', 'Payment Method Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function createPlan()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "Create New Investment Plan";
        $data['basic'] = BasicSetting::first();
        $data['compound'] = Compound::all();
        return view('plan.plan-create', $data);
    }
    public function storePlan(Request $request)
    {


        $this->validate($request,[
            'name' => 'required|unique:plans,name',
            'minimum' => 'required|integer',
            'maximum' => 'required|integer',
            'time' => 'required|integer',
            'compound_id' => 'required',
            'percent' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);
        $plan = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(445,350)->save($location);
            $plan['image'] = $filename;
        }
        $plan['status'] = $request->status == 'on' ? '1' : '0';
        Plan::create($plan);
        session()->flash('message', 'Investment Plan Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function showPlan()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "All Investment Plan";
        $data['basic'] = BasicSetting::first();
        $data['plan'] = Plan::all();
        return view('plan.plan-show', $data);
    }
    public function editPlan($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "All Investment Plan";
        $data['basic'] = BasicSetting::first();
        $data['plan'] = Plan::findOrFail($id);
        $data['compound'] = Compound::all();
        return view('plan.plan-edit', $data);
    }
    public function updatePlan(Request $request,$id)
    {


        $p = Plan::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:plans,name,'.$p->id,
            'minimum' => 'required|integer',
            'maximum' => 'required|integer',
            'time' => 'required|integer',
            'compound_id' => 'required',
            'percent' => 'required',
            'image' => 'mimes:jpg,png'
        ]);
        $plan = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(445,350)->save($location);
            $plan['image'] = $filename;
        }
        $plan['status'] = $request->status == 'on' ? '1' : '0';
        $p->fill($plan)->save();
        session()->flash('message', 'Investment Plan Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deletePlan(Request $request)
    {
        Plan::destroy($request->id);
        session()->flash('message', 'Plan Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function manageCompound()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Investment Compound";
        $data['category'] = Compound::all();
        return view('plan.plan-compound', $data);
    }
    public function storeCompound(Request $request)
    {


        $rules = array(
            'name' => 'required|unique:categories,name',
            'compound' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Compound::create($request->all());
            return Response::json($category);
        }
    }
    public function editCompound($task_id)
    {
        $category = Compound::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateCompound(Request $request,$task_id)
    {


        $cat = Compound::find($task_id);
        $rules = array(
            'name' => 'required|unique:compounds,name,'.$cat->id,
            'compound' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->name = $request->name;
            $cat->compound = $request->compound;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function adminDeposit()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Deposit History";
        $data['deposit'] = Deposit::orderBy('id','desc')->get();
        return view('dashboard.admin-deposit', $data);
    }
    public function adminRebeat()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Profit History";
        $data['repeat'] = RebeatLog::orderBy('id','ASC')->get();
        return view('dashboard.admin-rebeat', $data);
    }
    public function withdrawPending()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Pending";
        $data['withdraw'] = Withdraw::orderBy('id','desc')->whereStatus(0)->get();
        return view('dashboard.withdraw-pending', $data);
    }
    public function withdrawSuccessSubmit(Request $request)
    {

        $this->validate($request,[
            'id' => 'required'
        ]);
        $basic = BasicSetting::first();
        $withdraw = Withdraw::findOrFail($request->id);
        $widUser = User::findOrFail($withdraw->user_id);
        $ad['user_id'] = $widUser->id;
        $ad['balance_type'] = 6;
        $ad['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Payment With : ".$withdraw->withdrawMethod->title;
        $ad['balance'] = $withdraw->amount;
        $ad['old_balance'] = $basic->admin_total;
        $ad['new_balance'] = $basic->admin_total - ($withdraw->amount);

        $month = date('m');
        $nextmonth = date('m', strtotime("first day of +1 month"));
        $year = date('Y', strtotime("first day of 1 month"));
        $day = date('d');

        $withdrawalcnt = "";

        switch ($day) {
            case 25:
            case 26:
            case 27:
            case 28:
            case 29:
            case 30:
            case 31:
                $withdrawalcnt = DB::select("select Withdrawal from statement where user_id = ? AND month = ? AND year = ?", [$ad['user_id'], $nextmonth, $year]);
                break;
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
            case 22:
            case 23:
            case 24:
                $withdrawalcnt = DB::select("select Withdrawal from statement where user_id = ? AND month = ? AND year = ?", [$ad['user_id'], $month, $year]);
                break;
        }

        if (!empty($withdrawalcnt)) {

            foreach ($withdrawalcnt as $wcn) {
                $Withdra =  $ad['balance'] + $wcn->Withdrawal;
                DB::update("update statement set Withdrawal=? WHERE user_id=?", [$Withdra,$ad['user_id']]);
            }

        }
        else {
            DB::update("update statement set Withdrawal=? WHERE user_id=?", [$ad['balance'],$ad['user_id']]);
        }



        $basic->admin_total = $ad['new_balance'];
        AdminBalance::create($ad);
        $basic->save();
        $withdraw->status = 1 ;
        $withdraw->made_date = date('Y-m-d H:i:s');
        $withdraw->save();
        session()->flash('message', 'Withdraw Payment Complete Success.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function withdrawRefundSubmit(Request $request)
    {

        $this->validate($request,[
            'id' => 'required'
        ]);

        $basic = BasicSetting::first();
        $withdraw = Withdraw::findOrFail($request->id);
        $widUser = User::findOrFail($withdraw->user_id);
        $ad['user_id'] = $widUser->id;
        $ad['balance_type'] = 7;
        $ad['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Refunded By Admin.";
        $ad['balance'] = $withdraw->amount;
        $ad['charge'] = $withdraw->charge;
        $ad['old_balance'] = $basic->admin_total;
        $ad['new_balance'] = $basic->admin_total - ($withdraw->amount + $withdraw->charge);
        $basic->admin_total = $ad['new_balance'];
        AdminBalance::create($ad);
        $basic->save();
        $withdraw->status = 2 ;
        $withdraw->made_date = date('Y-m-d H:i:s');

        $us['user_id'] = $widUser->id;
        $us['balance_type'] = 7;
        $us['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Refunded By Admin.";
        $us['balance'] = $withdraw->amount;
        $us['charge'] = $withdraw->charge;
        $us['old_balance'] = $widUser->amount;
        $us['new_balance'] = $widUser->amount + ($withdraw->amount + $withdraw->charge);
        $widUser->amount = $us['new_balance'];
        $widUser->save();
        UserBalance::create($us);
        $withdraw->save();
        session()->flash('message', 'Withdraw Refunded Complete Success.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function withdrawSuccess()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Success";
        $data['withdraw'] = Withdraw::orderBy('id','desc')->whereStatus(1)->get();
        return view('dashboard.withdraw-success', $data);
    }
    public function withdrawRefund()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Refund";
        $data['withdraw'] = Withdraw::orderBy('id','desc')->whereStatus(2)->get();
        return view('dashboard.withdraw-refund', $data);
    }
    public function manageUser()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage User";
        $data['user'] = User::orderBy('id','DESC')->get();
        return view('dashboard.user-manage', $data);
    }
    public function userDetails(Request $request)
    {

        $member = User::findOrFail($request->id);
        $basic = BasicSetting::first();
        $image = url('/assets/images').'/'.$member->image;
        $total_ref = User::whereUnder_reference($member->reference)->count();
        $total_deposit = Deposit::whereUser_id($member->id)->sum('amount');
        $total_rebeat = RebeatLog::whereUser_id($member->id)->sum('balance');
        $total_reference = Reference::whereUser_id($member->id)->sum('balance');
        $total_withdraw = Withdraw::whereUser_id($member->id)->whereStatus(1)->sum('amount');
        return '<div style="padding-bottom: 0;" class="well well-lg">
            <div class="profile-header-container">
                <div class="profile-header-img">
                    <img class="img-circle" src="'.$image.'" />
                    <!-- badge -->
                    <div class="rank-label-container">
                        <span class="label label-default rank-label">'. $member->amount .' - '.$basic->currency .'</span>
                    </div>
                </div>
            </div>
            <div class="profile-body text-center">
                <h3>'.$member->name.' </h3>
                <h4> E-Mail : '. $member->email .'</h4>
                <h4> Phone : '. $member->phone .'</h4>
                <h4> Address : '. $member->address .'</h4>
                <h4> Reference ID : <span style="color: #fff;font-size: 13px;" class="label label-danger">'. $member->reference .'</span></h4>
                <h4> Reference Account : '. $total_ref .' - Account</h4>
                <h4> Bank Name : '. $member->bank_name .'</h4>
                <h4> Account Name : '. $member->acc_name .'</h4>
                <h4> Account Number : '. $member->acc_number .'</h4>
                <h4> Branch Code : '. $member->acc_code .'</h4>
                <hr>
                <table class="table table-bordered table-striped bold">
                    <thead>
                    <tr>
                        <th><b>Total Deposit</b></th>
                        <th><b>Total Rebeat</b></th>
                        <th><b>Total Reference</b></th>
                        <th><b>Total Withdraw</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>'.$total_deposit.' - '.$basic->currency.'</td>
                        <td>'.$total_rebeat.' - '.$basic->currency.'</td>
                        <td>'.$total_reference.' - '.$basic->currency.'</td>
                        <td>'.$total_withdraw.' - '.$basic->currency.'</td>
                       
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>';
    }
    public function userTransaction($id)
    {
        $user = User::findorFail($id);
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "$user->name Transaction Log.";
        $data['fund'] = Fund::whereUser_id($id)->orderBy('id','DESC')->get();
        return view('dashboard.user-transaction', $data);
    }
    public function userDeposit($id)
    {
        $user = User::findorFail($id);
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "$user->name Deposit Log.";
        $data['deposit'] = Deposit::whereUser_id($id)->orderBy('id','DESC')->get();
        return view('dashboard.user-deposit', $data);
    }
    public function userWithdraw($id)
    {
        $user = User::findorFail($id);
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "$user->name Withdraw Log.";
        $data['withdraw'] = Withdraw::whereUser_id($id)->orderBy('id','DESC')->get();
        return view('dashboard.user-withdraw', $data);
    }
    public function blockUser(Request $request)
    {

        $this->validate($request,[
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        $user->block_status = 1;
        $user->block_at = date('Y-m-d H:i:s');
        $user->save();
        session()->flash('message', 'User Successfully Blocked.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function unblockUser(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        $user->block_status = 0;
        $user->save();
        session()->flash('message', 'User Successfully UnBlocked.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function blockUserList()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "All Block User";
        $data['user'] = User::where('block_status',1)->orderBy('id','DESC')->get();
        return view('dashboard.user-block', $data);
    }
    public function latterCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create New Latter";
        $data['user'] = User::orderBy('id','DESC')->get();
        return view('dashboard.latter-create', $data);
    }
    public function latterStore(Request $request)
    {


        $basic = BasicSetting::first();

        $this->validate($request,[
            'subject' => 'required',
            'description' => 'required'
        ]);


        foreach ($request->user_id as $key => $value)
        {
            $user = User::findOrFail($value);
            $general = GeneralSetting::first();
            $mail_val = [
                'email' => $user->email,
                'name' => $user->name,
                'g_email' => $general->email,
                'g_title' => $general->title,
                'subject' => $request->subject,
            ];
            Config::set('mail.driver','mail');
            Config::set('mail.from',$general->email);
            Config::set('mail.name',$general->title);
            Mail::send('emails.news.letter', ['title' => $request->subject,'description'=>$request->description], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
        }

        $art = Letter::create($request->all());
        $art->users()->sync($request->user_id, false);
        session()->flash('message', 'Letter Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function getStrategy()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Strategy";
        $data['category'] = Strategy::orderBy('id', 'DESC')->paginate(10);
        return view('strategy.strategy', $data);
    }
    public function storeStrategy(Request $request)
    {


        $rules = array(
            'title' => 'required|unique:strategies,title',
            'image' => 'required|mimes:png',
            'description' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $ids = Input::except('_token');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename11 = time().'.'.$image->getClientOriginalExtension();
                $location = 'assets/images/' . $filename11;
                Image::make($image)->resize(112,104)->save($location);
                $ids['image'] = $filename11;
            }
            Strategy::create($ids);
            session()->flash('message', 'Strategy Created Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }
    }
    public function editStrategy($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Edit Strategy";
        $data['strategy'] = Strategy::findOrFail($id);
        return view('strategy.strategy-edit', $data);
    }
    public function updateStrategy(Request $request,$id)
    {


        $st = Strategy::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|unique:strategies,title,'.$st->id,
            'description' => 'required',
            'image' => 'mimes:png'
        ]);
        $ids = Input::except('_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename11 = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename11;
            Image::make($image)->resize(105,105)->save($location);
            $ids['image'] = $filename11;
        }
        $st->fill($ids)->save();
        session()->flash('message', 'Strategy Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function getManualPaymentRequest()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manual Payment Request";
        $data['fund'] = ManualFund::orderBy('id','desc')->get();
        return view('dashboard.manual-payment-request',$data);
    }
    public function viewManualPayment($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manual Payment Request";
        $data['fund'] = ManualFund::findOrFail($id);
        $data['img'] = Photo::whereFund_id($id)->get();
        return view('dashboard.manual-payment-request-view',$data);
    }
    public function manualPaymentConfirm(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $fund = ManualFund::findOrFail($request->id);
        $user = User::findOrFail($fund->user_id);



            $amount = $fund->log->amount;
            $freqid = $fund->user_id;
            $freq = $request->freq;
            $deposit_number = date('ymd').Str::random(6).rand(11,99);
            $plan_id = 1;
            $percent = 0;
            $time = 1;
            $compound_id = 1;
            $status = 1;
            date_default_timezone_set('Africa/Johannesburg');
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            $month = date('m');
            $year = date('Y');
            $day = date('d');

            $Opening_Balance = 0;
            $Percentage_Growth = 1;
            $Closing_Balance = 0;
            $Commission = 0.2;
            $Gross = 0;
            $Withdrawal = 0;
            $Payout = 0;
            $Growth_Added_Fund = 0;
            $Net_Balance = 0;
            $Growth_Amount = 0;
            $Commission_Amount = 0;
            $Next_Month_Opening_Balance = 0;


            switch ($day) {
                case 26:
                    $Growth_Added_Fund = $amount;
                    break;
                case 27:
                case 28:
                case 29:
                case 30:
                case 31:
                case 1:
                    //$Growth_Added_Fund = $amount * 0.75;
		    $Growth_Added_Fund = $amount;
                    break;
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                    //$Growth_Added_Fund = $amount * 0.5;
		    $Growth_Added_Fund = $amount;
                    break;
                case 10:
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                case 16:
                case 17:
                    //$Growth_Added_Fund = $amount * 0.25;
		    $Growth_Added_Fund = $amount;
                    break;
                case 18:
                case 19:
                case 20:
                case 21:
                case 22:
                case 23:
                case 24:
                case 25:
                    //$Growth_Added_Fund = $amount * 0.05;
		    $Growth_Added_Fund = $amount;
                    break;
            }

            if(($amount - $Growth_Added_Fund)== 0){
                $Closing_Added_Fund = 0;
            }else{
                $Closing_Added_Fund = $amount - $Growth_Added_Fund;
            }
		$Growth_Added_Fund = 0;

            DB::insert("insert into deposits (id,deposit_number,user_id,plan_id,percent,time,compound_id,amount,status,created_at,updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [NULL, $deposit_number, $freqid, $plan_id, $percent, $time, $compound_id, $amount, $status, $created_at, $updated_at]);

            DB::update("update manual_funds set made_time = now(), status = 1, created_at = ?, updated_at = ? WHERE id= ?", [$created_at, $updated_at, $freq ]);



        $nextmonth = date('m', strtotime("first day of +1 month"));
        $cnt = "";

        switch ($day) {
            case 25:
            case 26:
            case 27:
            case 28:
            case 29:
            case 30:
            case 31:
                $cnt = DB::select("select Opening_Balance,Added_Fund,Growth_Added_Fund,Closing_Added_Fund from statement where user_id = ? AND month = ? AND year = ?", [$freqid, $nextmonth, $year]);
                break;
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
            case 22:
            case 23:
            case 24:
                $cnt = DB::select("select Opening_Balance,Added_Fund,Growth_Added_Fund,Closing_Added_Fund from statement where user_id = ? AND month = ? AND year = ?", [$freqid, $month, $year]);
                break;
        }

            if (!empty($cnt)) {

                foreach ($cnt as $cn) {
                    $Opening_Balanc = $Growth_Added_Fund + $cn->Opening_Balance;
                    $Added_Fund = $amount + $cn->Added_Fund;
                    $Growth_Added_Fund = $Growth_Added_Fund + $cn->Growth_Added_Fund;
                    $Closing_Added_Fund = $Closing_Added_Fund + $cn->Closing_Added_Fund;

                    DB::update("update statement set Opening_Balance=?,Added_Fund=?,Growth_Added_Fund=?,Closing_Added_Fund=?,Commission=? WHERE user_id=?", [$Opening_Balanc,$Added_Fund,$Growth_Added_Fund,$Closing_Added_Fund,$Commission,$freqid]);
                }

            }
            else {
                switch ($day) {
                    case 25:
                    case 26:
                    case 27:
                    case 28:
                    case 29:
                    case 30:
                    case 31:
                        DB::insert("insert into statement (id,user_id,month,year,Opening_Balance,Added_Fund,Growth_Added_Fund,Closing_Added_Fund,Percentage_Growth,Closing_Balance,Commission,Gross,Withdrawal,Payout, Net_Balance, Growth_Amount, Commission_Amount, Next_Month_Opening_Balance) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [NULL, $freqid, $nextmonth, $year, $amount, $amount, $Growth_Added_Fund, $Closing_Added_Fund, $Percentage_Growth, $Closing_Balance, $Commission, $Gross, $Withdrawal, $Payout,$Net_Balance,$Growth_Amount,$Commission_Amount,$Next_Month_Opening_Balance]);
                        break;
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                    case 10:
                    case 11:
                    case 12:
                    case 13:
                    case 14:
                    case 15:
                    case 16:
                    case 17:
                    case 18:
                    case 19:
                    case 20:
                    case 21:
                    case 22:
                    case 23:
                    case 24:
                        DB::insert("insert into statement (id,user_id,month,year,Opening_Balance,Added_Fund,Growth_Added_Fund,Closing_Added_Fund,Percentage_Growth,Closing_Balance,Commission,Gross,Withdrawal,Payout, Net_Balance, Growth_Amount, Commission_Amount, Next_Month_Opening_Balance) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [NULL, $freqid, $month, $year, $amount, $amount, $Growth_Added_Fund, $Closing_Added_Fund, $Percentage_Growth, $Closing_Balance, $Commission, $Gross, $Withdrawal, $Payout,$Net_Balance,$Growth_Amount,$Commission_Amount,$Next_Month_Opening_Balance]);
                        break;
                }
            }


        // User Log
        $ur['user_id'] = $fund->user_id;
        $ur['balance_type'] = 8;
        $ur['details'] = "Add Fund via ".$fund->log->method->name.' '."Transaction ID : # ".$fund->log->transaction_id;
        $ur['balance'] = $fund->log->amount;
        $ur['charge'] = $fund->log->charge;
        $ur['new_balance'] = $user->amount + $fund->log->amount;
        $ur['old_balance'] = $user->amount;
        UserBalance::create($ur);
        $user->amount = $ur['new_balance'];
        $user->save();

        $basic = BasicSetting::first();
        // Admin Log
        $ad['user_id'] = $fund->user_id;
        $ad['balance_type'] = 8;
        $ad['details'] = "Add Fund via ".$fund->log->method->name.' '."Transaction ID : # ".$fund->log->transaction_id;
        $ad['balance'] = $fund->log->amount;
        $ad['charge'] = $fund->log->charge;
        $ad['new_balance'] = $basic->admin_total + $fund->log->total;
        $ad['old_balance'] = $basic->admin_total;
        AdminBalance::create($ad);
        $basic->admin_total = $ad['new_balance'];
        $basic->save();
        $fund->status = 1;
        $fund->made_time =  date('Y-m-d H:i:s');
        $fund->save();
         session()->flash('message', 'Manual Payment Successfully Completed.');
         Session::flash('type', 'success');
         Session::flash('title', 'success');
        return redirect()->back();
    }
    public function createPartner()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create Partner";
        return view('partner.partner-create',$data);
    }
    public function storePartner(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|mimes:png'
        ]);
        $nu = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(170,75)->save($location);
            $nu['image'] = $filename;
        }
        Partner::create($nu);
        session()->flash('message', 'Partner Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function showPartner()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "All Partner";
        $data['partner'] = Partner::all();
        return view('partner.partner-show',$data);
    }
    public function editPartner($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Edit Partner";
        $data['partner'] = Partner::findOrFail($id);
        return view('partner.partner-edit',$data);
    }
    public function updatePartner(Request $request,$id)
    {
        $pt = Partner::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:png'
        ]);
        $part = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(170,75)->save($location);
            $part['image'] = $filename;
        }
        $pt->fill($part)->save();
        session()->flash('message', 'Partner Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function deletePartner(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        Partner::destroy($request->id);
        session()->flash('message', 'Partner Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function manageChose()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Chose US";
        $data['chose'] = Chose::orderBy('id','DESC')->paginate(10);
        return view('dashboard.chose-manage',$data);
    }
    public function storeChose(Request $request)
    {
        $rules = array(
            'title' => 'required',
            's_text' => 'required',
            'icon' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Chose::create($request->all());
            return Response::json($category);
        }
    }
    public function editChose($task_id)
    {
        $category = Chose::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateChose(Request $request,$task_id)
    {
        $cat = Chose::find($task_id);
        $rules = array(
            'title' => 'required',
            's_text' => 'required',
            'icon' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->title = $request->title;
            $cat->s_text = $request->s_text;
            $cat->icon = $request->icon;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function managePromo()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Promo";
        $data['promo'] = Promo::orderBy('id','DESC')->paginate(10);
        return view('dashboard.promo-manage',$data);
    }
    public function storePromo(Request $request)
    {
        $rules = array(
            'title' => 'required|unique:promos,title',
            'icon' => 'required',
            's_text' => 'required',
            'number' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Promo::create($request->all());
            return Response::json($category);
        }
    }
    public function editPromo($task_id)
    {
        $category = Promo::findOrFail($task_id);
        return Response::json($category);
    }
    public function updatePromo(Request $request,$task_id)
    {
        $cat = Promo::find($task_id);
        $rules = array(
            'title' => 'required|unique:promos,title,'.$cat->id,
            'icon' => 'required',
            's_text' => 'required',
            'number' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->title = $request->title;
            $cat->icon = $request->icon;
            $cat->number = $request->number;
            $cat->s_text = $request->s_text;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function manageTestimonial()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Testimonial";
        $data['testimonial'] = Testimonial::orderBy('id','DESC')->paginate(10);
        return view('dashboard.testimonial-manage',$data);
    }
    public function storeTestimonial(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Testimonial::create($request->all());
            return Response::json($category);
        }
    }
    public function editTestimonial($task_id)
    {
        $category = Testimonial::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateTestimonial(Request $request,$task_id)
    {
        $cat = Testimonial::find($task_id);
        $rules = array(
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->name = $request->name;
            $cat->position = $request->position;
            $cat->description = $request->description;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function sliderCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create New Slider";
        return view('dashboard.slider-create',$data);
    }
    public function sliderStore(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $sl = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(1920,650)->save($location);
            $sl['image'] = $filename3;
        }
        Slider::create($sl);
        session()->flash('message', 'Slider Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function sliderShow()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Show Slider";
        $data['slider'] = Slider::all();
        return view('dashboard.slider-show',$data);
    }
    public function sliderEdit($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Edit Slider";
        $data['slider'] = Slider::findOrFail($id);
        return view('dashboard.slider-edit',$data);
    }
    public function sliderUpdate(Request $request,$id)
    {
        $sll = Slider::findOrFail($id);
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $sl = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(1920,650)->save($location);
            $sl['image'] = $filename3;
        }
        $sll->fill($sl)->save();
        session()->flash('message', 'Slider Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function sliderDelete(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $sl = Slider::findOrFail($request->id);
        $sl->delete();
        session()->flash('message', 'Slider Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }

}
