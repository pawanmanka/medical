<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
  
    public function __construct()
    {
     
    }
    public function index()
    {
          return view('contactus');
    }

   
}
