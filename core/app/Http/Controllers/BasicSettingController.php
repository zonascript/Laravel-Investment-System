<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use App\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class BasicSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $data = [];
        $general_all = GeneralSetting::first();
        $this->site_title = $general_all->title;
        $this->site_color = $general_all->color;
        $this->footer_text = $general_all->footer_text;
    }
    public function getBasicSetting()
    {
        $data['page_title'] = "Basic Setting";
        $general_all = GeneralSetting::first();
        $data['site_title'] = $general_all->title;
        $data['general'] = $general_all;
        $data['basic'] = BasicSetting::first();
        return view('basic.basic-setting',$data);
    }
    protected function putBasicSetting(Request $request,$id)
    {

        
        $this->validate($request,[
           'reference_bonus' => 'required',
           'reference' => 'required',
           'reference_id' => 'required',
           'currency' => 'required',
           'symbol' => 'required',
           'site_key' => 'required',
           'secret_key' => 'required',
        ]);
        $bas = Input::except('_method','_token');
        $bas['registration_status'] = $request->registration_status == 'on' ? '1' : '0';
        $bas['verify_status'] = $request->verify_status == 'on' ? '1' : '0';
        $bas['reCaptcha_status'] = $request->reCaptcha_status == 'on' ? '1' : '0';
        $bas['withdraw_status'] = $request->withdraw_status == 'on' ? '1' : '0';
        $basic = BasicSetting::findOrFail($id);
        $basic->fill($bas)->save();
        session()->flash('message', 'Basic Setting Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }


}
