<?php

namespace App\Http\Controllers;

use App\AdminBalance;
use App\BasicSetting;
use App\Category;
use App\Chose;
use App\Deposit;
use App\Fund;
use App\FundLog;
use App\GeneralSetting;
use App\Menu;
use App\News;
use App\Page;
use App\Partner;
use App\Payment;
use App\Plan;
use App\Promo;
use App\Slider;
use App\Strategy;
use App\Testimonial;
use App\User;
use App\UserBalance;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\RebeatLog;
use App\Repeat;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Home Page";
        $data['plan'] = Plan::whereStatus(1)->get();
        $data['strategy'] = Strategy::take(6)->get();
        $data['page'] = Page::first();
        $data['menu'] = Menu::all();
        $data['slider'] = Slider::all();
        $data['promo'] = Promo::all();
        $data['testimonial'] = Testimonial::all();
        $data['chose'] = Chose::all();
        $data['news'] = News::orderBy('id','DESC')->take(2)->get();
        $data['news_rand'] = News::inRandomOrder()->take(4)->get();
        $data['partner'] = Partner::all();
        $data['payment'] = Payment::first();
        $data['category'] = Category::all();
        /*return view('home.home',$data);*/
        return view('home.new-home',$data);
    }

    public function getLogin()
    {
        return redirect()->route('login');
    }

    public function getAbout()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['page_title'] = "About US";
        $data['page'] = Page::first();
        $data['payment'] = Payment::first();
        $data['category'] = Category::all();
        $data['tt'] = 'about';
        return view('home.about',$data);
    }
    public function getFaq()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Faqs Page";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'faq';
        return view('home.about',$data);
    }
    public function getDocument()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['payment'] = Payment::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['page_title'] = "Document Page";
        $data['page'] = Page::first();
        $data['tt'] = 'document';
        return view('home.about',$data);
    }
    public function getTerms()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Terms & Condition";
        $data['payment'] = Payment::first();
        $data['category'] = Category::all();
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['tt'] = 'terms';
        return view('home.about',$data);
    }
    public function getBandbook()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "BrandBook";
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['menu'] = Menu::all();
        $data['tt'] = 'bankbook';
        return view('home.about',$data);
    }
    public function getPrivacy()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['page_title'] = "Privacy Page";
        $data['payment'] = Payment::first();
        $data['page'] = Page::first();
        $data['tt'] = 'privacy';
        return view('home.about',$data);
    }
    public function getContact()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['page_title'] = "Contact Page";
        $data['payment'] = Payment::first();
        return view('home.contact',$data);
    }
    public function submitContact(Request $request)
    {
        $this->validate($request,[
           'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $general = GeneralSetting::first();
        $mail_val = [
            'email' => $request->email,
            'name' => $request->name,
            'g_email' => $general->email,
            'g_title' => $general->title,
            'subject' => $request->subject,
            'sub' => 'Contact Message'
        ];
        Mail::send('emails.contact', ['subject' => $request->subject,'name' => $request->name,'phone' => $request->phone,'description'=>$request->message], function ($m) use ($mail_val) {
            $m->from($mail_val['email'], $mail_val['name']);
            $m->to($mail_val['g_email'], $mail_val['g_title'])->subject($mail_val['sub']);
        });

        session()->flash('message', 'Message Successfully Send.');
        return redirect()->back();
    }
    public function getNews()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "News Page";
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['payment']  = Payment::first();
        $data['news'] = News::orderBy('id','DESC')->paginate(5);
        $data['news_rand'] = News::inRandomOrder()->take(15)->get();
        return view('home.news',$data);
    }
    public function newsDetails($id,$slug)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['news'] = News::findOrFail($id);
        $v = News::findOrFail($id);
        $v->view = $v->view + 1;
        $v->save();
        $data['payment']  = Payment::first();
        $data['news_rand'] = News::inRandomOrder()->take(15)->get();
        $data['page_title'] = $data['news']->title;
        return view('home.news-details',$data);
    }
    public function categoryNews($id,$slug)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['news_rand'] = News::inRandomOrder()->take(15)->get();
        $data['payment'] = Payment::first();
        $data['news'] = News::whereCategory_id($id)->orderBy('id','DESC')->paginate(10);
        $data['page_title'] = 'Category Wise News';
        return view('home.news',$data);
    }
    public function menu($id)
    {
        $data['page_title'] =  'Menu';
        $data['general'] = GeneralSetting::first();
        $gen = GeneralSetting::first();
        $data['payment'] = Payment::first();
        $data['site_title'] = $gen->title;
        $data['category'] = Category::all();
        $data['menu'] = Menu::all();
        $data['menu1'] = Menu::findOrFail($id);
        return view('home.menu',$data);
    }
    public function perfectIPN()
    {
        $pay = Payment::first();
        $passphrase=strtoupper(md5($pay->perfect_alternate));

        define('ALTERNATE_PHRASE_HASH',  $passphrase);
        define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
        $string=
            $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
            $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
            $_POST['PAYMENT_BATCH_NUM'].':'.
            $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
            $_POST['TIMESTAMPGMT'];

        $hash=strtoupper(md5($string));
        $hash2 = $_POST['V2_HASH'];

        if($hash==$hash2){

            $amo = $_POST['PAYMENT_AMOUNT'];
            $unit = $_POST['PAYMENT_UNITS'];
            $depoistTrack = $_POST['PAYMENT_ID'];
            $funlog = FundLog::whereTransaction_id($depoistTrack)->first();

            $ammch = $funlog->fix + (($funlog->amount * $funlog->percent) / 100);

            $amm = round((($funlog->amount + $ammch) / $funlog->rate),2) ;

            $main_am = $amm;

            if($_POST['PAYEE_ACCOUNT']=="$pay->perfect_acount" && $unit=="USD" && $amo ==$main_am){

                $user = User::findOrFail($funlog->user_id);
                $basic = BasicSetting::first();

                // Fun Log
                $fu['user_id'] = $user->id;
                $fu['payment_type'] = 2;
                $fu['transaction_id'] = $funlog->transaction_id;
                $fu['amount'] = $funlog->amount;
                $fu['rate'] = $funlog->rate;
                $fu['charge'] = $ammch;
                $fu['total'] = $main_am;
                Fund::create($fu);

                // user Log
                $us['user_id'] = $user->id;
                $us['balance_type'] = 1;
                $us['details'] = "Fund Add via Perfect Money. Transaction id : # ".$funlog->transaction_id;
                $us['balance'] = $funlog->amount;
                $us['charge'] = $ammch;
                $us['old_balance'] = $user->amount;
                $us['new_balance'] = $user->amount + ($funlog->amount);
                UserBalance::create($us);
                $user->amount = $us['new_balance'];
                $user->save();

                // Admin log
                $ad['user_id'] = $user->id;
                $ad['balance_type'] = 1;
                $ad['details'] = "Fund Deposit via Perfect Money. Transaction id : # ".$funlog->transaction_id;
                $ad['balance'] = $funlog->amount;
                $ad['charge'] = $ammch;
                $ad['old_balance'] = $basic->admin_total;
                $ad['new_balance'] = $ammch + $basic->admin_total + $funlog->amount;
                AdminBalance::create($ad);
                $basic->admin_total = round($ad['new_balance'],3);
                $basic->save();
                
                session()->flash('message','Fund Successfully Deposit.');
                session()->flash('type','success');
                session()->flash('title','Success');
                return redirect()->route('add-fund');
                
            }
        }
    }
    public function paypalIpn()
    {
        $payment_type		=	$_POST['payment_type'];
        $payment_date		=	$_POST['payment_date'];
        $payment_status		=	$_POST['payment_status'];
        $address_status		=	$_POST['address_status'];
        $payer_status		=	$_POST['payer_status'];
        $first_name			=	$_POST['first_name'];
        $last_name			=	$_POST['last_name'];
        $payer_email		=	$_POST['payer_email'];
        $payer_id			=	$_POST['payer_id'];
        $address_country	=	$_POST['address_country'];
        $address_country_code	=	$_POST['address_country_code'];
        $address_zip		=	$_POST['address_zip'];
        $address_state		=	$_POST['address_state'];
        $address_city		=	$_POST['address_city'];
        $address_street		=	$_POST['address_street'];
        $business			=	$_POST['business'];
        $receiver_email		=	$_POST['receiver_email'];
        $receiver_id		=	$_POST['receiver_id'];
        $residence_country	=	$_POST['residence_country'];
        $item_name			=	$_POST['item_name'];
        $item_number		=	$_POST['item_number'];
        $quantity			=	$_POST['quantity'];
        $shipping			=	$_POST['shipping'];
        $tax				=	$_POST['tax'];
        $mc_currency		=	$_POST['mc_currency'];
        $mc_fee				=	$_POST['mc_fee'];
        $mc_gross			=	$_POST['mc_gross'];
        $mc_gross_1			=	$_POST['mc_gross_1'];
        $txn_id				=	$_POST['txn_id'];
        $notify_version		=	$_POST['notify_version'];
        $custom				=	$_POST['custom'];

        $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $payment = Payment::first();
        $paypal_email = $payment->paypal_email;

        if($payer_status=="verified" && $payment_status=="Completed" && $receiver_email==$paypal_email && $ip=="notify.paypal.com"){

            $data = FundLog::where('transaction_id' , $custom)->first();

            $charge = $payment->paypal_fix + ($data->amount * $payment->paypal_percent / 100);
            $totalamo = round(($data->amount + $charge) / $payment->paypal_rate,3);

            if($totalamo == $mc_gross)
            {
                $uuuu = User::findOrFail($data->user_id);
                $data->status = 1;

                // Fun Create

                $fun['user_id'] = $data->user_id;
                $fun['payment_type'] = 1;
                $fun['transaction_id'] = $data->transaction_id;
                $fun['amount'] = $data->amount;
                $fun['rate'] = $data->rate;
                $fun['charge'] = $charge;
                $fun['total'] = $mc_gross;
                Fund::create($fun);

                // User Log Create

                $us['user_id'] = $data->user_id;
                $us['payment_type'] = 1;
                $us['derails'] = "Fund Add via Paypal. Transaction id : # ".$data->transaction_id;
                $us['balance'] = $data->amount;
                $us['charge'] = $charge;
                $us['old_balance'] = $uuuu->amount;
                $us['new_balance'] = $data->amount + $us['old_balance'];
                $uuuu->amount = $us['new_balance'];
                $uuuu->save();
                UserBalance::create($us);

                // Admin Log

                $bas = BasicSetting::first();
                $ad['user_id'] = $data->user_id;
                $ad['payment_type'] = 1; //paypal
                $ad['transaction_id'] = $data->transaction_id;
                $ad['balance'] = $data->amount;
                $ad['details'] = "Fund Deposit via Paypal. Transaction ID : # ".$data->transaction_id;
                $ad['charge'] = $charge;
                $ad['old_balance'] = $bas->admin_total;
                $ad['new_balance'] = $bas->admin_total + $data->amount + $charge;
                AdminBalance::create($ad);
                $bas->admin_total = $ad['new_balance'];
                $bas->save();
                $data->save();
                
                session()->flash('message','Fund Successfully Deposit.');
                session()->flash('type','success');
                session()->flash('title','Success');
                return redirect()->route('add-fund');
            
                
            }
        }
    }
    public function btcIPN()
    {
        $depoistTrack = $_GET['invoice_id'];
        $secret = $_GET['secret'];
        $address = $_GET['address'];
        $value = $_GET['value'];
        $confirmations = $_GET['confirmations'];
        $value_in_btc = $_GET['value'] / 100000000;

        $trx_hash = $_GET['transaction_hash'];

        $DepositData = FundLog::whereTransaction_id($depoistTrack)->first();

        if ($DepositData->status == 0){

        if ($DepositData->btc_amo == $value_in_btc && $DepositData->btc_acc == $address && $secret=="ABIR" && $confirmations>2){

            $charge = $DepositData->fix + ($DepositData->amount * $DepositData->percent) / 100;
            $uuuu = User::findOrFail($DepositData->user_id);

            // Fun Create

            $fun['user_id'] = $DepositData->user_id;
            $fun['payment_type'] = 1;
            $fun['transaction_id'] = $DepositData->transaction_id;
            $fun['amount'] = $DepositData->amount;
            $fun['rate'] = $DepositData->rate;
            $fun['charge'] = $charge;
            $fun['total'] = $DepositData->btc_amo;
            Fund::create($fun);

            // User Log Create

            $us['user_id'] = $DepositData->user_id;
            $us['payment_type'] = 1;
            $us['derails'] = "Fund Add via BlockChain. Transaction id : # ".$DepositData->transaction_id;
            $us['balance'] = $DepositData->amount;
            $us['charge'] = $charge;
            $us['old_balance'] = $uuuu->amount;
            $us['new_balance'] = $DepositData->amount + $us['old_balance'];
            $uuuu->amount = $us['new_balance'];
            $uuuu->save();
            UserBalance::create($us);

            // Admin Log

            $bas = BasicSetting::first();
            $ad['user_id'] = $DepositData->user_id;
            $ad['payment_type'] = 3; //Blockchain
            $ad['transaction_id'] = $DepositData->transaction_id;
            $ad['balance'] = $DepositData->amount;
            $ad['details'] = "Fund Deposit via BlockChain. Transaction ID : # ".$DepositData->transaction_id;
            $ad['charge'] = $charge;
            $ad['old_balance'] = $bas->admin_total;
            $ad['new_balance'] = $bas->admin_total + $DepositData->amount + $charge;
            AdminBalance::create($ad);
            $bas->admin_total = $ad['new_balance'];
            $bas->save();
            
            session()->flash('message','Fund Successfully Deposit.');
                session()->flash('type','success');
                session()->flash('title','Success');
                return redirect()->route('add-fund');
        }
        }
    }
    public function withdrawDetails(Request $request)
    {
        $basic = BasicSetting::first();
        $id = $request->id;
        $wid = Withdraw::findOrFail($id);
        if($wid->status == 0)
            $st = '<span class="label label-secondary"><i class="fa fa-spinner"></i> Pending</span>';
        elseif($wid->status == 1)
            $st = '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Completed</span>';
        else
            $st = '<span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Refunded</span>';

        if($wid->made_date == null)
            $md = '<span class="label label-danger"><i class="fa fa-times"></i> Not Seen Yet.</span>';
        else
            $md = Carbon::parse($wid->made_date)->format('d F Y h:i:s A');

        return '<div class="modal-body">

                    <div class="row">
                        <div class="com-sm-12">
                            <div class="text-center">
                            <h3>Submitted Date : <strong><i>'.Carbon::parse($wid->created_at)->format('d F Y h:i:s A').'</i></strong></h3>
                            <h3>Created At : <strong><i>'.Carbon::parse($wid->created_at)->diffForHumans().'</i></strong></h3>
                            <h3>Bank Name : <strong><i>'.$wid->withdrawMethod->title.'</i></strong></h3>
                            <h3>Account Name : <strong><i>'.$wid->acc_name.'</i></strong></h3>
                            <h3>Account Number : <strong><i>'.$wid->acc_number.'</i></strong></h3>
                            <h3>Swift Code : <strong><i>'.$wid->acc_code.'</i></strong></h3>
                            <h3>Amount : <strong><i>'.$basic->symbol.' '. $wid->amount.' '.$basic->currency.'</i></strong></h3>
                            <h3>Charge : <strong><i>'.$basic->symbol.' '. $wid->charge.' '.$basic->currency.'</i></strong></h3>
                            <h3>Total Cutted : <strong><i>'.$basic->symbol.' '. $wid->total.' '.$basic->currency.'</i></strong></h3>
                            <h3>Present Balance : <strong><i>'.$basic->symbol.' '. $wid->new_balance.' '.$basic->currency.'</i></strong></h3>
                            <h3>Past Balance : <strong><i>'.$basic->symbol.' '. $wid->old_balance.' '.$basic->currency.'</i></strong></h3>
                            <h3>Status : <strong><i>'.$st.'</i></strong></h3>
                            <h3>Made Date : <strong><i>'.$md.'</i></strong></h3>
                            <hr>
                            <h3><strong>Message : </strong> '.$wid->message.'</h3>
                            </div>
                        </div>
                    </div>
                </div>';

    }
    public function rebetgen()
    {
        $now = Carbon::parse();
        $rep = Repeat::whereStatus(0)->get();
        $basic = BasicSetting::first();
        foreach ($rep as $r){
            if ($r->repeat_time < $now){
                $user = User::findOrFail($r->user_id);
                $ra = Repeat::findOrFail($r->id);
                if ($ra->rebeat != $r->deposit->time){
                    $us['user_id'] = $user->id;
                    $us['balance_type'] = 3;
                    $us['balance'] = ($r->deposit->amount * $r->deposit->percent) / 100;
                    $us['old_balance'] = $user->amount;
                    $us['new_balance'] = $user->amount + $us['balance'];
                    $us['details'] = "Invest ID: # ".$r->deposit->deposit_number.' '."Invest Plan : ".$r->deposit->plan->name;
                    $user->amount = $us['new_balance'];
                    UserBalance::create($us);
                    $user->save();
                    $log['user_id'] = $user->id;
                    $log['deposit_id'] = $r->deposit->id;
                    $log['balance'] = $us['balance'];
                    $log['made_time'] = Carbon::now();
                    RebeatLog::create($log);
                    $ra->made_time = Carbon::now();
                    $ra->repeat_time = Carbon::parse()->addHours($r->deposit->compound->compound);
                    $ra->rebeat = $ra->rebeat + 1;
                    $ra->save();

                    $ad1['user_id'] = $user->id;
                    $ad1['balance_type'] = 3;
                    $ad1['balance'] = $us['balance'];
                    $ad1['old_balance'] = $basic->admin_total;
                    $ad1['new_balance'] = $basic->admin_total - $us['balance'];
                    $ad1['details'] = "Invest ID: # ".$r->deposit->deposit_number.'; '."Invest Plan : ".$r->deposit->plan->name;
                    AdminBalance::create($ad1);
                    $basic->admin_total = $ad1['new_balance'];
                    $basic->save();

                }else{
                    $ra->status = 1;
                    $ra2 = Deposit::findOrFail($ra->id);
                    $ra2->status = 1;
                    $ra2->save();
                    $ra->save();
                }

            }
        }
    }

}
