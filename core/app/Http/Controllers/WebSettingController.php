<?php

namespace App\Http\Controllers;

use App\About;
use App\Faqs;
use App\GeneralSetting;
use App\BasicSetting;
use App\HomeImage;
use App\Menu;
use App\Page;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class WebSettingController extends Controller
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
    public function getGeneralSetting()
    {
        $data['page_title'] = "General Setting";
        $general_all = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['site_title'] = $general_all->title;
        $data['general'] = $general_all;
        return view('websetting.general_setting',$data);
    }
    public function putGeneralSetting(Request $request, $id)
    {
        

        $this->validate($request,[
            'title' => 'required',
            'images' => 'mimes:png'
        ]);
        try {
            $generals = GeneralSetting::find($id);
            $general = Input::except('_method', '_token');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = "logo".'.'.$image->getClientOriginalExtension();
                $location = 'assets/images/' . $filename;
                Image::make($image)->resize(225,60)->save($location);
                $general['logo'] = $filename;
            }
            if($request->hasFile('image1')){
                $image11 = $request->file('image1');
                $filename11 = time().'.'.$image11->getClientOriginalExtension();
                $location = 'assets/images/' . $filename11;
                Image::make($image11)->resize(32,32)->save($location);
                $general['favicon'] = $filename11;
            }
            $generals->fill($general)->save();
            session()->flash('message', 'General Setting Updated Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', "$e ------ome Problem Occurs, Please Try Again!");
            Session::flash('type', 'danger');
            return redirect()->back();
        }

    }
    public function homeImage()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Home Page Image";
        $data['image'] = HomeImage::first();
        $data['basic'] = BasicSetting::first();
        return view('websetting.image-show',$data);
    }
    public function manageSlider()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Manage Slider";
        $data['slider'] = Slider::all();
        return view('websetting.slider',$data);
    }
    public function postSlider(Request $request)
    {
        
        $this->validate($request,[
           'text' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $ge = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/upload/' . $filename;
            Image::make($image)->resize(1920,750)->save($location);
            $ge['image'] = $filename;
        }
        Slider::create($ge);
        session()->flash('message', 'Slider Created Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function deleteSlider(Request $request)
    {
        $this->validate($request,[
           'id' => 'required'
        ]);
        $s = Slider::findOrFail($request->id);
        Storage::delete($s->image);
        $s->delete();
        session()->flash('message', 'Slider Deleted Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();

    }
    public function updateHomeImage(Request $request,$id)
    {

        $img = HomeImage::findOrFail($id);
        $this->validate($request,[
           'top_image' => 'mimes:png,jpg,jpeg',
            'middle_image' => 'mimes:png,jpg,jpeg',
            'bottom_image' => 'mimes:png,jpg,jpeg',
        ]);
        $image = Input::except('_method','_token');
        if($request->hasFile('top_image')){
            $image1 = $request->file('top_image');
            $filename1 = time().'h1'.'.'.$image1->getClientOriginalExtension();
            $location = 'assets/images/' . $filename1;
            Image::make($image1)->resize(1300,720)->save($location);
            $image['top_image'] = $filename1;
        }
        if($request->hasFile('middle_image')){
            $image2 = $request->file('middle_image');
            $filename2 = time().'h2'.'.'.$image2->getClientOriginalExtension();
            $location = 'assets/images/' . $filename2;
            Image::make($image2)->resize(1200,853)->save($location);
            $image['middle_image'] = $filename2;
        }
        if($request->hasFile('bottom_image')){
            $image3 = $request->file('bottom_image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(1200,400)->save($location);
            $image['bottom_image'] = $filename3;
        }
        $img->fill($image)->save();
        session()->flash('message', 'Home Image Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();

    }
    public function createAbout()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "About Page";
        $data['about'] = About::first();
        return view('websetting.about-show',$data);
    }
    public function updateAbout(Request $request,$id)
    {
        
        $ab = About::findOrFail($id);
        $this->validate($request,[
           'description' => 'required'
        ]);
        $ab->fill($request->all())->save();
        session()->flash('message', 'About Page Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function createFAQS()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "FAQS Create";
        return view('websetting.faqs-create',$data);
    }
    public function storeFAQS(Request $request)
    {
        $this->validate($request,[
           'title' => 'required',
            'description' => 'required'
        ]);
        Faqs::create($request->all());
        session()->flash('message', 'FAQS Created Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function showFAQS()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "All FAQS";
        $data['faqs'] = Faqs::orderBy('id','DESC')->get();
        return view('websetting.faqs-show',$data);
    }
    public function editFAQS($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Edit FAQS";
        $data['faqs'] = Faqs::findOrFail($id);
        return view('websetting.faqs-edit',$data);
    }
    public function updateFAQS(Request $request,$id)
    {
        
        $fa = Faqs::findOrFail($id);
        $this->validate($request,[
           'title' => 'required',
            'description' => 'required'
        ]);
        $fa->fill($request->all())->save();
        session()->flash('message', 'FAQS Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getAbout()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Manage About";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page'] = Page::first();
        return view('websetting.about-edit',$data);
    }
    public function putAbout(Request $request,$id)
    {

        
        $this->validate($request,[
           'about' => 'required'
        ]);
        $page = Page::findOrFail($id);
        $page->fill($request->all())->save();
        session()->flash('message', 'About Page Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getFAQS()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Manage FAQ";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page'] = Page::first();
        return view('websetting.faq-edit',$data);
    }
    public function putFAQS(Request $request,$id)
    {

        
        $this->validate($request,[
            'faq' => 'required'
        ]);
        $page = Page::findOrFail($id);
        $page->fill($request->all())->save();
        session()->flash('message', 'FAQS Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getDocument()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Manage Document";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page'] = Page::first();
        return view('websetting.document-edit',$data);
    }
    public function putDocument(Request $request,$id)
    {
        
        $this->validate($request,[
            'document' => 'required'
        ]);
        $page = Page::findOrFail($id);
        $page->fill($request->all())->save();
        session()->flash('message', 'Document Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getTerms()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Manage Term & Condition";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page'] = Page::first();
        return view('websetting.terms-edit',$data);
    }
    public function putTerms(Request $request,$id)
    {
        
        $this->validate($request,[
            'terms' => 'required'
        ]);
        $page = Page::findOrFail($id);
        $page->fill($request->all())->save();
        session()->flash('message', 'Term & Condition Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getPrivacy()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Manage Privacy";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page'] = Page::first();
        return view('websetting.privacy-edit',$data);
    }
    public function putPrivacy(Request $request,$id)
    {
        
        $this->validate($request,[
            'privacy' => 'required'
        ]);
        $page = Page::findOrFail($id);
        $page->fill($request->all())->save();
        session()->flash('message', 'Privacy Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getBandbook()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Manage Brand Book";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page'] = Page::first();
        return view('websetting.brandbook-edit',$data);
    }
    public function putBrandbook(Request $request,$id)
    {
        $this->validate($request,[
            'bankbook' => 'required'
        ]);
        $page = Page::findOrFail($id);
        $page->fill($request->all())->save();
        session()->flash('message', 'Brandbook Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }

    public function getMenuCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create Menu Setting";
        return view('websetting.menu-create',$data);
    }
    public function postMenuCreate(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:menus,name',
            'description' => 'required'
        ]);
        try {
            $menu = Input::except('_method','_token');
            Menu::create($menu);
            session()->flash('message', 'Menu Create Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function showMenuCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Show All Menu";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        return view('websetting.menu-show',$data);
    }
    public function editMenuCreate($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Edit Menu";
        $data['menu'] = Menu::findorFail($id);
        return view('websetting.menu-edit',$data);
    }
    public function updateMenuCreate(Request $request,$id)
    {
        $menus = Menu::findOrFail($id);
        $this->validate($request,[
            'name' =>'required|unique:menus,name,'.$menus->id,
            'description' => 'required'
        ]);
        try {
            $menu = Input::except('_method','_token');
            $menus->fill($menu)->save();
            session()->flash('message', 'Menu Updated Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function deleteMenuCreate($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            session()->flash('message', 'Menu Deleted Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }











}
