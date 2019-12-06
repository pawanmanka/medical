<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->data = array();
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       return view('home',$this->data);
    }
    
    public function page(Request $request)
    {
       return $this->_pageData($request->segment(1));
    }

    private function _pageData($slug){
      $PageObj = Page::whereSlug($slug)->first();
      if(!isset($PageObj->id)) abort('404');
      $this->data['title'] = $PageObj->name;
      $this->data['content'] = $PageObj->content;
      return view('page',$this->data);
    }

    public function register()
    {
       return view('register');
    }
    public function search()
    {   $this->data['title'] = 'Search';
      $this->_getListData(array(config('application.doctor_role'),config('application.hospital_role'),config('application.lab_role')));
       return view('search',$this->data);
    }
  
    public function doctors()
    {   
        $this->data['title'] = 'Doctors';
        $this->_getListData(array(config('application.doctor_role')));
        return view('listing',$this->data);
    }
    public function hospitals()
    {   
        $this->data['title'] = 'Hospitals';
        $this->_getListData(array(config('application.hospital_role')));
        return view('listing',$this->data);
    }
    public function labs()
    {   
        $this->data['title'] = 'Labs';
        $this->_getListData(array(config('application.lab_role')));
        return view('listing',$this->data);
    }

    private function _getListData($roles)
    {
       $userObj = User::whereHas('roles',function($query) use($roles){
         $query->whereIn('name',$roles);
       })
       ->with('getUserInformation')->whereNotNull('mobile_verified_at')
       ->where('status',config('application.user_active_status'))
       ->paginate(config('application.listing_item_limit'));
       //dd($userObj);
       $this->data['result'] = $userObj->items();
       $this->data['paging'] = $userObj;
    }
}
