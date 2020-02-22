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
Route::get('/testing','HomeController@testing');
Route::get('/contact-us','ContactusController@index');
//Auth::routes();

Route::get('/search','HomeController@search');

Route::get('/doctors','HomeController@doctors');
Route::get('/hospitals','HomeController@hospitals');
Route::get('/labs','HomeController@labs');

Route::get('/detail/{seoname}','HomeController@detail');

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/register', 'HomeController@register');

Route::get('patient/register', 'RegisterController@patient');
Route::post('patient/register', 'RegisterController@patientSave');

Route::get('doctor/register', 'RegisterController@doctor');
Route::post('doctor/register', 'RegisterController@doctorSave');

Route::get('hospital/register', 'RegisterController@hospital');
Route::post('hospital/register', 'RegisterController@hospitalSave');

Route::get('/forgot-password', 'ForgotPasswordController@index');
Route::post('/forgot-password', 'ForgotPasswordController@sendVerificationSms');
Route::get('/reset-password', 'ForgotPasswordController@resetPage');
Route::post('/reset-password', 'ForgotPasswordController@resetPassword');

Route::get('lab/register', 'RegisterController@lab');
Route::post('lab/register', 'RegisterController@labSave');

Route::get('verifyOtp/{mobile}', 'RegisterController@verifyOtp');
Route::post('verifyOtp/{mobile}', 'RegisterController@verifyOtpData');
Route::get('resendVerifyOtp', 'RegisterController@resendVerifyOtp');



// login
Route::get('login', 'LoginController@loginUser')->name('login');

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

Route::get('/getCategory', 'HomeController@getCategory');

Route::group(['middleware'=>['role:patient|hospital|doctor|lab','userAuth']],function(){
    Route::get('/dashboard','ProfileController@dashboard');

    Route::get('/profile','ProfileController@index');
    Route::post('/profile','ProfileController@save');
   
   

    Route::group(['middleware'=>['role:doctor']],function(){
        Route::get('/choose-calendar-option','ProductController@doctorProducts');
        Route::get('/bulk-create-slots','ProductController@bulkCreateSlots');
        Route::post('/bulk-create-slots','ProductController@bulkSlotSave');
        Route::get('/create-slots','ProductController@createSlots');
        Route::post('/create-slots','ProductController@slotSave');
        Route::get('/create-slots/{id}','ProductController@createSlots');
        Route::post('/create-slots/{id}','ProductController@slotSave');
        Route::get('/get-slots','ProductController@getSlots');
        Route::get('/products/grid','ProductController@grid');
    });
    
    Route::group(['middleware'=>['role:lab']],function(){
        Route::get('/my-services','ProductController@labProducts');
        Route::get('/my-services/grid','ProductController@grid');
        Route::get('/my-services/add','ProductController@labProductAdd');
        Route::post('/my-services/add','ProductController@labProductSave');
        Route::get('/my-services/edit/{id}','ProductController@labProductAdd');
        Route::post('/my-services/edit/{id}','ProductController@labProductSave');
        

        Route::get('/my-packages','ProductController@labProducts');
        Route::get('/my-packages/grid','ProductController@grid');
        Route::get('/my-packages/add','ProductController@labProductAdd');
        Route::post('/my-packages/add','ProductController@labProductSave');
        Route::get('/my-packages/edit/{id}','ProductController@labProductAdd');
        Route::post('/my-packages/edit/{id}','ProductController@labProductSave');
        
        
    });

    //booking
    Route::group(['middleware'=>['role:'.config('application.wallet_add_roles')]],function(){

        Route::get('/booking/{slug}','BookingController@index');
        Route::get('/booking/{slug}/{item}','BookingController@index');
        
        Route::post('/booking/{slug}/get-slots','BookingController@getSlots');
        Route::post('/booking/{slug}/{item}','BookingController@save');
        Route::post('/wallet/add-money','WalletController@addMoney');
        Route::post('/wallet/pay-success','WalletController@paySuccess');

                
        Route::post('/saveReview', 'HomeController@createReview');
        Route::post('/saveQuestion', 'HomeController@createQuestion');
    });

    Route::get('/my-wallet','WalletController@index');
    Route::get('/my-wallet/grid','WalletController@grid');
    Route::get('/my-appointment','AppointmentController@index');
    Route::get('/appointment/grid','AppointmentController@grid');
    
    //extra_info_roles
    Route::group(['middleware'=>['role:'.config('application.extra_info_roles')]],function(){
        Route::get('/extra-info','ProfileController@extraInfo');
        Route::post('/extra-info','ProfileController@extraInfoSave');
        
        Route::get('/my-feedbacks','ProfileController@MyFeedbacks');
        Route::get('/my-feedback/grid','ProfileController@MyFeedbackGrid');
        Route::post('/my-feedback/statusChange','ProfileController@MyFeedbackStatusChange');
        Route::get('/my-qa/grid','ProfileController@MyQAGrid');
        Route::post('/my-qa/statusChange','ProfileController@MyQuestionStatusChange');
        Route::post('/saveAnswer','ProfileController@saveAnswer');


        Route::get('/appointment/cancel/{code}','AppointmentController@cancel');  
    });

});


Route::prefix('administrator')->middleware('isAdmin')->namespace('Admin')->group(function(){
    Route::get('/', 'HomeController@index');
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/change-mobile-number/{id}', 'UserCommonController@changeMobileNumber');
    Route::post('/change-mobile-number/{id}', 'UserCommonController@sendChangeMobileNumber');
    
    Route::get('/change-mobile-number/{id}/{mobile_number}', 'UserCommonController@changeMobileNumberOtp');
    Route::post('/change-mobile-number/{id}/{mobile_number}', 'UserCommonController@changeMobileNumberSuccessfully');
    
    // page
    Route::group(['middleware' => ['permission:add page|edit page|delete page']], function () {
    
        Route::get('/page/list', 'PageController@index');
        Route::get('/page/grid', 'PageController@grid');
    
        Route::group(['middleware' => ['permission:add page']], function () {
            Route::get('/page/add', 'PageController@add');
            Route::post('/page/add', 'PageController@save');
        });
        Route::group(['middleware' => ['permission:edit page']], function () {
            Route::get('/page/edit/{id}', 'PageController@edit');
            Route::post('/page/edit/{id}', 'PageController@save');
        });
        Route::group(['middleware' => ['permission:delete page']], function () {
            Route::post('/page/delete', 'PageController@delete');
        });
    
    });

    // amenities
    Route::group(['middleware' => ['permission:add amenities|edit amenities|delete amenities']], function () {
    
        Route::get('/amenities/list', 'AmenitiesController@index');
        Route::get('/amenities/grid', 'AmenitiesController@grid');
    
        Route::group(['middleware' => ['permission:add amenities']], function () {
            Route::get('/amenities/add', 'AmenitiesController@add');
            Route::post('/amenities/add', 'AmenitiesController@save');
        });
        Route::group(['middleware' => ['permission:edit amenities']], function () {
            Route::get('/amenities/edit/{id}', 'AmenitiesController@edit');
            Route::post('/amenities/edit/{id}', 'AmenitiesController@save');
        });
        Route::group(['middleware' => ['permission:delete amenities']], function () {
            Route::post('/amenities/delete', 'AmenitiesController@delete');
        });
    
    });

     // plans
     Route::group(['middleware' => ['permission:add plans|edit plans|delete plans']], function () {
    
        Route::get('/plans/list', 'PlansController@index');
        Route::get('/plans/grid', 'PlansController@grid');
    
        Route::group(['middleware' => ['permission:add plans']], function () {
            Route::get('/plans/add', 'PlansController@add');
            Route::post('/plans/add', 'PlansController@save');
        });
        Route::group(['middleware' => ['permission:edit plans']], function () {
            Route::get('/plans/edit/{id}', 'PlansController@edit');
            Route::post('/plans/edit/{id}', 'PlansController@save');
        });
        Route::group(['middleware' => ['permission:delete plans']], function () {
            Route::post('/plans/delete', 'PlansController@delete');
        });
    
    });

    //categories
    Route::group(['middleware' => ['permission:add category|edit category|delete category']], function () {
        Route::get('/category/list', 'CategoryController@index');
        Route::get('/category/grid', 'CategoryController@grid');
        Route::group(['middleware' => ['permission:add category']], function () {
            Route::get('/category/add', 'CategoryController@add');
            Route::post('/category/add', 'CategoryController@save');
        });
        Route::group(['middleware' => ['permission:edit category']], function () {
            Route::get('/category/edit/{id}', 'CategoryController@edit');
            Route::post('/category/edit/{id}', 'CategoryController@save');
        });
        Route::group(['middleware' => ['permission:delete category']], function () {
            Route::post('/category/delete', 'CategoryController@delete');
        });
    });

    //permission_management
    Route::group(['middleware' => ['permission:add subadmin|edit subadmin|delete subadmin']], function () {

        Route::get('/permission_management/list', 'SubUserController@index');
        Route::get('/permission_management/grid', 'SubUserController@grid');
        Route::group(['middleware' => ['permission:add subadmin']], function () {
            Route::get('/permission_management/add', 'SubUserController@add');
            Route::post('/permission_management/add', 'SubUserController@save');
        });
        Route::group(['middleware' => ['permission:edit subadmin']], function () {
            Route::get('/permission_management/edit/{id}', 'SubUserController@edit');
            Route::post('/permission_management/edit/{id}', 'SubUserController@save');
        });
        Route::group(['middleware' => ['permission:delete subadmin']], function () {
            Route::post('/permission_management/delete', 'SubUserController@delete');
        });
    });
    //patient
    Route::group(['middleware' => ['permission:add patient|edit patient|delete patient']], function () {
        Route::get('/patient/list', 'PatientController@index');
        Route::get('/patient/grid', 'PatientController@grid');
        Route::get('/patient/edit/{id}', 'PatientController@edit');
        Route::post('/patient/edit/{id}', 'PatientController@saveUser');
        Route::post('/patient/delete', 'UserCommonController@deleteUser');
    });
    Route::get('/user/appointment-grid', 'PatientController@appointmentGrid');
    Route::get('/user/reviews-grid', 'PatientController@reviewsGrid');
    Route::get('/user/qa-grid', 'PatientController@MyQAGrid');

    Route::group(['middleware' => ['permission:edit hospital|edit patient|edit doctor|edit lab']], function () {
       Route::post('/user/changeStatus', 'UserCommonController@ChangeStatus');
    });

    Route::group(['middleware' => ['permission:add doctor|edit doctor|delete doctor']], function () {
        Route::get('/doctor/list', 'DoctorController@index');
        Route::get('/doctor/grid', 'DoctorController@grid');
        Route::get('/doctor/edit/{id}', 'PatientController@edit');
        Route::post('/doctor/edit/{id}', 'PatientController@saveUser');
        Route::post('/doctor/delete', 'UserCommonController@deleteUser');

    });

    Route::group(['middleware' => ['permission:add hospital|edit hospital|delete hospital']], function () {
        Route::get('/hospital/list', 'HospitalController@index');
        Route::get('/hospital/grid', 'HospitalController@grid');
        Route::get('/hospital/edit/{id}', 'PatientController@edit');
        Route::post('/hospital/edit/{id}', 'PatientController@saveUser');
        Route::post('/hospital/delete', 'UserCommonController@deleteUser');

    });
   
    Route::group(['middleware' => ['permission:add lab|edit lab|delete lab']], function () {
        Route::get('/lab/list', 'LabController@index');
        Route::get('/lab/grid', 'LabController@grid');
        Route::get('/lab/edit/{id}', 'PatientController@edit');
        Route::post('/lab/edit/{id}', 'PatientController@saveUser');
        Route::post('/lab/delete', 'UserCommonController@deleteUser');

    });
});

Route::get('/{slug}', 'HomeController@page');
