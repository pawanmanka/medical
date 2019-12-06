<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller{
    
    public function __construct()
    {
      $this->data['menu'] = 'dashboard';    
    }

    public function index(Request $request){
        return view('admin.dashboard',$this->data);
    }
}