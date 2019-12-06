<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index');


Route::get('/about-us','AboutusController@index');
Route::get('/contact-us','ContactusController@index');

//Auth::routes();

Route::get('/search','HomeController@search');

Route::get('/doctors','HomeController@doctors');
Route::get('/hospitals','HomeController@hospitals');
Route::get('/labs','HomeController@labs');


Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/register', 'HomeController@register');

Route::get('patient/register', 'RegisterController@patient');
Route::post('patient/register', 'RegisterController@patientSave');

Route::get('doctor/register', 'RegisterController@doctor');
Route::post('doctor/register', 'RegisterController@doctorSave');

Route::get('hospital/register', 'RegisterController@hospital');
Route::post('hospital/register', 'RegisterController@hospitalSave');

Route::get('lab/register', 'RegisterController@lab');
Route::post('lab/register', 'RegisterController@labSave');

Route::get('verifyOtp/{mobile}', 'RegisterController@verifyOtp');
Route::post('verifyOtp/{mobile}', 'RegisterController@verifyOtpData');
Route::get('resendVerifyOtp', 'RegisterController@resendVerifyOtp');



// login
Route::get('login', 'LoginController@loginUser');

Route::get('patient/login', 'LoginController@showLoginForm');
Route::post('patient/login', 'LoginController@login');

Route::get('doctor/login', 'LoginController@showLoginForm');
Route::post('doctor/login', 'LoginController@login');

Route::get('hospital/login', 'LoginController@showLoginForm');
Route::post('hospital/login', 'LoginController@login');

Route::get('lab/login', 'LoginController@showLoginForm');
Route::post('lab/login', 'LoginController@login');




Route::get('/home', 'HomeController@index')->name('home');

 Route::get('/administrator', 'Admin\LoginController@showLoginForm');
Route::get('/administrator/login', 'Admin\LoginController@showLoginForm');
Route::post('/administrator/login', 'Admin\LoginController@login')->name('administratorLogin');
Route::get('/administrator/logout', 'Admin\LoginController@logout');


Route::group(['middleware'=>['role:patient|hospital|doctor|lab']],function(){
    Route::get('/dashboard','ProfileController@dashboard');

    Route::get('/profile','ProfileController@index');
    Route::post('/profile','ProfileController@save');
   
    Route::get('/extra-info','ProfileController@extraInfo');
    Route::post('/extra-info','ProfileController@extraInfoSave');
    

    Route::group(['middleware'=>['role:doctor']],function(){
        Route::get('/choose-calendar-option','ProductController@doctorProducts');
        Route::get('/create-slots','ProductController@createSlots');
        Route::get('/get-slots','ProductController@getSlots');
    });

    Route::post('/product/grid','ProductController@grid');

});


Route::prefix('administrator')->middleware('isAdmin')->namespace('Admin')->group(function(){
    Route::get('/', 'HomeController@index');
    Route::get('/dashboard', 'HomeController@index');
    
    // page
    Route::get('/page/list', 'PageController@index');
    Route::get('/page/grid', 'PageController@grid');
    Route::get('/page/add', 'PageController@add');
    Route::post('/page/add', 'PageController@save');
    Route::get('/page/edit/{id}', 'PageController@edit');
    Route::post('/page/edit/{id}', 'PageController@save');
    Route::post('/page/delete', 'PageController@delete');

    //categories
    Route::get('/category/list', 'CategoryController@index');
    Route::get('/category/grid', 'CategoryController@grid');
    Route::get('/category/add', 'CategoryController@add');
    Route::post('/category/add', 'CategoryController@save');
    Route::get('/category/edit/{id}', 'CategoryController@edit');
    Route::post('/category/edit/{id}', 'CategoryController@save');
    Route::post('/category/delete', 'CategoryController@delete');
   
    //permission_management
    Route::get('/permission_management/list', 'SubUserController@index');
    Route::get('/permission_management/grid', 'SubUserController@grid');
    Route::get('/permission_management/add', 'SubUserController@add');
    Route::post('/permission_management/add', 'SubUserController@save');
    Route::get('/permission_management/edit/{id}', 'SubUserController@edit');
    Route::post('/permission_management/edit/{id}', 'SubUserController@save');
    Route::post('/permission_management/delete', 'SubUserController@delete');
   
    //patient
    Route::get('/patient/list', 'PatientController@index');
    Route::get('/patient/grid', 'PatientController@grid');
    // Route::get('/patient/add', 'PatientController@add');
    // Route::post('/patient/add', 'PatientController@save');
    // Route::get('/patient/edit/{id}', 'PatientController@edit');
    // Route::post('/patient/edit/{id}', 'PatientController@save');
    // Route::post('/patient/delete', 'PatientController@delete');

    Route::get('/doctor/list', 'DoctorController@index');
    Route::get('/doctor/grid', 'DoctorController@grid');
  
    Route::get('/hospital/list', 'HospitalController@index');
    Route::get('/hospital/grid', 'HospitalController@grid');

    Route::get('/lab/list', 'LabController@index');
    Route::get('/lab/grid', 'LabController@grid');

});

Route::get('/{slug}', 'HomeController@page');
