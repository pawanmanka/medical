<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\PaymentGateway;
use App\Models\Category;
use App\Models\HospitalDoctor;
use App\Models\Question;
use App\Models\Review;
use App\Models\User;
use App\Models\Amenities;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\UserCertificate;
use App\Models\UserInformation;
use App\Models\UserPhoto;
use App\Models\UserPhotos;
use App\Models\Wallet;
use App\Models\WalletTrans;
use App\Traits\DatatableGrid;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller{
    use UploadImage;
    use DatatableGrid;

    public function __construct()
    {
       $this->data = array();
    } 

    public function dashboard(Request $request)
    {

        $this->data['title'] ='Dashboard'; 
        return view('dashboard',$this->data);
    }
    public function index()
    {
        $user = auth()->user();
        $role = $user->roles()->first();
        $this->data['categories'] = array();    
        $this->data['categoryArr'] = array();
        $role_wih_category = array_flip(config('application.role_wih_category'));
        $this->data['record'] =$user; 
        if(isset($role_wih_category[$role->name])){
            $this->_getCategory($role_wih_category[$role->name]);

        }
        $this->data['certificates']= $record = UserCertificate::where('user_id',auth()->id())->get();
        $this->data['photos'] = UserPhotos::where('user_id',auth()->id())->get();

        $this->data['title'] ='Profile'; 
        return view('profile',$this->data);
    }


    public function save(Request $request){
        $user = auth()->user();
        if($user->hasRole(config('application.patient_role'))){
             return $this->patientSave($request);
        }
        else if($user->hasRole(config('application.doctor_role'))){
            return $this->doctorSave($request);
        }
        else if($user->hasRole(config('application.hospital_role'))){
            return $this->hospitalSave($request);
        }
        else if($user->hasRole(config('application.lab_role'))){
            return $this->labSave($request);
        }
        else{
            flash('Some thing is wrong')->error()->important();
            return back()->withInput();  
        }
    }

    public function patientSave($request)
    {
            $userObj = User::find(auth()->id());
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->id_proof_type = $request->id_proof_type;
            $userObj->id_proof = $request->id_proof;
            $userObj->gender = $request->gender;
            $userObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/profile");
    }

    public function doctorSave($request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'sub_category' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'registration_number' => ['required','string'],
        'location' => ['required','string'],
        'hospital' => ['required','string'],
        'qualification' => ['required','string'],
        'email' => ['required', 'string','max:255'],
        'meta_title' => ['required'],
        'meta_description' => ['required'],
        'meta_keyword' => ['required']
       ];
       if(!empty($request->profile_image)){
        $rules['profile_image'] =   ['image','mimes:'.config('application.valid_image_mimes')];
       }
     
        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){

            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{

         
            $userObj = User::find(auth()->id());
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();


            $userInformationObj = UserInformation::where('user_id',$userObj->id)->first();
            $userInformationObj->category = $request->category;
            $userInformationObj->sub_category = $request->sub_category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->registration_number = $request->registration_number;
            $userInformationObj->address = $request->location;
            $userInformationObj->hospital = $request->hospital;
            $userInformationObj->qualification = $request->qualification;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $oldImage = config('application.users_image_path').'/'.$userInformationObj->profile_image;
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),$oldImage,'profile_image');
            }
            $userInformationObj->meta_title = $request->meta_title;
            $userInformationObj->meta_keyword = $request->meta_keyword;
            $userInformationObj->meta_description = $request->meta_description;
           
            $this->_uploadCertificate($request);
            $userInformationObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/profile");      
        }
        
    }
    
    public function _uploadCertificate($request)
    {
      
            // doctors
            $oldUserCertificates = UserCertificate::where('user_id',auth()->id())->pluck('id','id')->toArray();
            $value = $request->certificate; 
            if(!empty($value)){
                foreach ($value['id'] as $index => $name) {
                    $id = isset($value['id'][$index])?$value['id'][$index]:0;
                    $title = isset($value['name'][$index])?$value['name'][$index]:'';
                    $userCertificateObj = !empty($id)?UserCertificate::find($id):new UserCertificate();
                    $userCertificateObj->user_id = auth()->id();
                    if(isset($value['image'][$index])){
                        $oldImage =null;
                        if(isset($userCertificateObj->file_name)){
                            $oldImage = config('application.certificate_image_path').'/'.$userCertificateObj->file_name;
                        }
                        $userCertificateObj->file_name =   $this->fileUploadFile($value['image'][$index],config('application.certificate_image_path'),$oldImage);
                    }
                    $userCertificateObj->title = $title;
                    $userCertificateObj->save();
                    if(isset($oldUserCertificates[$userCertificateObj->id])){
                        unset($oldUserCertificates[$userCertificateObj->id]);
                    }
            }
            }
            if(!empty($oldUserCertificates)){
               $records = UserCertificate::where('user_id',auth()->id())->whereIn('id',$oldUserCertificates)->delete();

            }
    }
    public function uploadPhoto($request)
    {
      
            // doctors
            $oldRecords = UserPhotos::where('user_id',auth()->id())->pluck('id','id')->toArray();
            $value = $request->photo; 
            if(!empty($value)){
                foreach ($value['id'] as $index => $name) {
                    $id = isset($value['id'][$index])?$value['id'][$index]:0;
                    $userCertificateObj = !empty($id)?UserPhotos::find($id):new UserPhotos();
                    $userCertificateObj->user_id = auth()->id();
                    if(isset($value['image'][$index])){
                        $oldImage =null;
                        if(isset($userCertificateObj->file_name)){
                            $oldImage = config('application.user_photos_path').'/'.$userCertificateObj->file_name;
                        }
                        $userCertificateObj->file_name =   $this->fileUploadFile($value['image'][$index],config('application.user_photos_path'),$oldImage);
                    }
                    $userCertificateObj->save();
                    if(isset($oldRecords[$userCertificateObj->id])){
                        unset($oldRecords[$userCertificateObj->id]);
                    }
            }
            }
            if(!empty($oldRecords)){ 
                if(isset($value['image'])){
               $records = UserPhotos::where('user_id',auth()->id())->whereIn('id',$oldRecords)->delete();

            }
            }
    }

    public function hospitalSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'location' => ['required','string'],
        'email' => ['required', 'string','max:255'],
          'meta_title' => ['required'],
        'meta_description' => ['required'],
        'meta_keyword' => ['required']
           ];
       if(!empty($request->profile_image)){
        $rules['profile_image'] =   ['image','mimes:'.config('application.valid_image_mimes')];
       }
        $validatorObj =   \Validator::make($request->all(),$rules);

        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{

        
            $userObj = User::find(auth()->id());
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();
            

            // user information

            $userInformationObj = UserInformation::where('user_id',$userObj->id)->first();
            $userInformationObj->category = $request->category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->address = $request->location;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $oldImage = config('application.users_image_path').'/'.$userInformationObj->profile_image;
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),$oldImage,'profile_image');
            }
             $userInformationObj->meta_title = $request->meta_title;
            $userInformationObj->meta_keyword = $request->meta_keyword;
            $userInformationObj->meta_description = $request->meta_description;
                        $userInformationObj->hospital_service = !empty($request->hospital_servic)?json_encode($request->hospital_servic):'{}';

            $userInformationObj->save();

                 // doctors
                 $oldDoctors = HospitalDoctor::where('user_id',auth()->id())->pluck('id','id')->toArray();
                 $value = $request->doctor; 
                 if(!empty($value)){
                     foreach ($value['name'] as $index => $name) {
                         if(empty($name)) continue;
                         $id = isset($value['id'][$index])?$value['id'][$index]:0;
                         $doctor = !empty($id)?HospitalDoctor::find($id):new HospitalDoctor();
                         $ProductItem = $this->_saveProduct($name,$doctor,$userInformationObj);
                         $doctor->product_id = $ProductItem->product_id;
                         $doctor->name = $name;
                         $doctor->user_id = auth()->id();
                         $doctor->experience = isset($value['experience'][$index])?$value['experience'][$index]:'';
                         $doctor->timing = isset($value['timing'][$index])?$value['timing'][$index]:'';
                         $doctor->specification = isset($value['specification'][$index])?$value['specification'][$index]:'';
                         if(isset($value['image'][$index])){
                             $oldImage =null;
                             if(isset($doctor->image)){
                                 $oldImage = config('application.hospital_doctor_image_path').'/'.$doctor->image;
                             }
                             $doctor->image =   $this->fileUploadFile($value['image'][$index],config('application.hospital_doctor_image_path'),$oldImage);
                         }
                         $doctor->save();
                         if(isset($oldDoctors[$doctor->id])){
                             unset($oldDoctors[$doctor->id]);
                         }
                 }
                 }
                 if(!empty($oldDoctors)){
                    $records = HospitalDoctor::where('user_id',auth()->id())->whereIn('id',$oldDoctors)->get();
                    $productIds = array();
                    foreach ($records as $key => $value) {
                     $productIds[$value->product_id] = $value->product_id; 
                    }
                   HospitalDoctor::where('user_id',auth()->id())->whereIn('id',$oldDoctors)->delete();
                   if(!empty($productIds)){
                       Product::where('user_id',auth()->id())->whereIn('id',$oldDoctors)->delete();
                       ProductItem::whereIn('product_id',$oldDoctors)->delete();
                   }
     
                 }
     
                
     
                  $this->_uploadCertificate($request);
                  $this->uploadPhoto($request);

            flash('Update Successfully')->success()->important();
            return redirect("/profile");    
           
        }
        
    }

    
    public function labSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required'],
        'category.*' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'location' => ['required','string'],
        'email' => ['required', 'string','max:255'],
        'meta_title' => ['required'],
        'meta_description' => ['required'],
        'meta_keyword' => ['required']
       ];
     
       if(!empty($request->profile_image)){
        $rules['profile_image'] =   ['image','mimes:'.config('application.valid_image_mimes')];
       }
        $validatorObj =   \Validator::make($request->all(),$rules);

        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{

          
            $userObj = User::find(auth()->id());
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();

             //getLabCategory
             $userObj->getLabCategory()->sync($request->category);
             // user information
 
            // user information

            $userInformationObj = UserInformation::where('user_id',$userObj->id)->first();
           // $userInformationObj->category = $request->category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->address = $request->location;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $oldImage = config('application.users_image_path').'/'.$userInformationObj->profile_image;
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),$oldImage,'profile_image');
            }
            $userInformationObj->meta_title = $request->meta_title;
            $userInformationObj->meta_keyword = $request->meta_keyword;
            $userInformationObj->meta_description = $request->meta_description;
           

            $userInformationObj->save();

            $this->_uploadCertificate($request);
            $this->uploadPhoto($request);
            flash('Update Successfully')->success()->important();
            return redirect("/profile");    
                
        }
        
    }

    private function _getCategory($superCategoryId){
        $categories = array(); 
        $categoryArr = array(); 
        $categoryObj =  Category::where('super_category_id',$superCategoryId)->get();
         foreach ($categoryObj as $key => $category) {
             if($category->parent_id == 0){
                 $categories[$category->id] = $category->name; 
                // $categoryArr[$category->id]['name'] =  $category->name;
                }
             else{
                $categoryArr[$category->parent_id][$category->id] =  $category->name;
             }
         }  
         $this->data['categories'] = $categories;    
         $this->data['categoryArr'] = $categoryArr;    
    }


    // extraInfo

    public function extraInfo()
    {   
        $this->data['record']= $record = UserInformation::where('user_id',auth()->id())->first();
        $this->data['certificates']= $record = UserCertificate::where('user_id',auth()->id())->get();
        $this->data['photos'] = UserPhotos::where('user_id',auth()->id())->get();
        
        $this->data['amenities']= Amenities::pluck('name','id')->toArray();
        $this->data['title'] ='Extra Information'; 
        return view('extra_information',$this->data);
    }

    public function extraInfoSave(Request $request)
    {
        $user = auth()->user();
        if($user->hasRole(config('application.doctor_role'))){
            return $this->doctorExtraSave($request);
        }
        else if($user->hasRole(config('application.hospital_role'))){
            return $this->hospitalExtraSave($request);
        }
        else if($user->hasRole(config('application.lab_role'))){
            return $this->labExtraSave($request);
        }
        else{
            flash('Some thing is wrong')->error()->important();
            return back()->withInput();  
        }
    }

    public function doctorExtraSave($request)
    {
        
       $rules =  [
        // 'm_to_s_morning_start' => ['required'],
        // 'm_to_s_morning_end' => ['required'],
        // 'm_to_s_evening_start' => ['required'],
        // 'm_to_s_evening_end' => ['required'],
        // 's_evening_start' => ['required'],
        // 's_evening_end' => ['required'],
        'actual_fee' => ['required'],
        'discounted_fee' => ['required'],
        // 'meta_title' => ['required'],
        // 'meta_description' => ['required'],
        // 'meta_keyword' => ['required']
       ];

       if(!empty($request->home_visit)){
        $rules['h_m_s_morning_start'] =   ['required'];
        $rules['h_m_s_morning_end'] =   ['required'];
        $rules['h_m_s_evening_start'] =   ['required'];
        $rules['h_m_s_evening_end'] =   ['required'];
        $rules['h_s_morning_start'] =   ['required'];
        $rules['h_s_morning_end'] =   ['required'];
       }
     
        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $userInformationObj = UserInformation::where('user_id',auth()->id())->first();
            $userInformationObj->weekly_timing = json_encode($request->weekly_timing);

            // $userInformationObj->m_to_s_morning_start = date("H:i", strtotime($request->m_to_s_morning_start));
            // $userInformationObj->m_to_s_morning_end = date("H:i", strtotime($request->m_to_s_morning_end));
            // $userInformationObj->m_to_s_evening_start = date("H:i", strtotime($request->m_to_s_evening_start));
            // $userInformationObj->m_to_s_evening_end = date("H:i", strtotime($request->m_to_s_evening_end));
            // $userInformationObj->s_evening_end = date("H:i", strtotime($request->s_evening_end));
            // $userInformationObj->s_evening_start = date("H:i", strtotime($request->s_evening_start));

            if(!empty($request->home_visit)){
                $userInformationObj->h_m_s_morning_start = date("H:i", strtotime($request->h_m_s_morning_start));
                $userInformationObj->h_m_s_morning_end = date("H:i", strtotime($request->h_m_s_morning_end));
                $userInformationObj->h_m_s_evening_start = date("H:i", strtotime($request->h_m_s_evening_start));
                $userInformationObj->h_m_s_evening_end = date("H:i", strtotime($request->h_m_s_evening_end));
                $userInformationObj->h_s_morning_start = date("H:i", strtotime($request->h_s_morning_start));
                $userInformationObj->h_s_morning_end = date("H:i", strtotime($request->h_s_morning_end));
            }
            else{
                $userInformationObj->h_m_s_morning_start = 0;
                $userInformationObj->h_m_s_morning_end = 0;
                $userInformationObj->h_m_s_evening_start = 0;
                $userInformationObj->h_m_s_evening_end = 0;
                $userInformationObj->h_s_morning_start =0;
                $userInformationObj->h_s_morning_end = 0;
            }
            $userInformationObj->home_visit = !empty($request->home_visit)?$request->home_visit:0;
            
            $userInformationObj->doctor_education = $request->education;
            $userInformationObj->services = $request->services;
            $userInformationObj->specializations = $request->specializations;
            $userInformationObj->actual_fee = $request->actual_fee;
            $userInformationObj->discounted_fee = $request->discounted_fee;
          


            $userInformationObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/extra-info");      
        }
        
    }
    public function hospitalExtraSave($request)
    {

       $rules =  [
        'm_to_s_morning_start' => ['required'],
        'm_to_s_morning_end' => ['required'],
        'm_to_s_evening_start' => ['required'],
        'm_to_s_evening_end' => ['required'],
        's_evening_start' => ['required'],
        's_evening_end' => ['required'],
        'facility' => ['required'],
        // 'meta_title' => ['required'],
        // 'meta_description' => ['required'],
        // 'meta_keyword' => ['required']
       ];

     
        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $userInformationObj = UserInformation::where('user_id',auth()->id())->first();
            
            $userInformationObj->m_to_s_morning_start = date("H:i", strtotime($request->m_to_s_morning_start));
            $userInformationObj->m_to_s_morning_end = date("H:i", strtotime($request->m_to_s_morning_end));
            $userInformationObj->m_to_s_evening_start = date("H:i", strtotime($request->m_to_s_evening_start));
            $userInformationObj->m_to_s_evening_end = date("H:i", strtotime($request->m_to_s_evening_end));
            $userInformationObj->s_evening_end = date("H:i", strtotime($request->s_evening_end));
            $userInformationObj->s_evening_start = date("H:i", strtotime($request->s_evening_start));

            $userInformationObj->mode_of_payment = $request->mode_of_payment;
            $userInformationObj->facility = $request->facility;
            $userInformationObj->actual_fee = $request->actual_fee;
            $userInformationObj->discounted_fee = $request->discounted_fee;
            // $userInformationObj->meta_title = $request->meta_title;
            // $userInformationObj->meta_keyword = $request->meta_keyword;
            // $userInformationObj->meta_description = $request->meta_description;
            $userInformationObj->save();
 //amenities
 if(!empty($request->amenities)){
    $userInformationObj->getAmenities()->sync($request->amenities);
 }
       


            flash('Update Successfully')->success()->important();
            return redirect("/extra-info");      
        }
        
    }

    private function _saveProduct($name,$doctor,$userInformationObj){
        $actualFee = $userInformationObj->actual_fee;
        $discountFee=$userInformationObj->discounted_fee;
        $productId=$doctor->product_id;

        $productObj  = !empty($productId)?Product::find($productId):new Product();
        $productObj->type  = Product::$HOSPITAL;  
        $productObj->name  = $name;
        $productObj->user_id  =  auth()->id();
        $productObj->save();

        $productItems = $productObj->productItems->first();
        $productItemObj  = isset($productItems->id)?$productItems:new ProductItem();
        $productItemObj->product_id=$productObj->id;
        $productItemObj->name=$name;
        if(empty($productItemObj->code)){
            $productItemObj->code =  $productItemObj->generateUniqueCode();
        }
        $productItemObj->actual_price=$actualFee;
        $productItemObj->discount_price=$discountFee;
        $productItemObj->save();
        return $productItemObj;
    }


    public function labExtraSave($request)
    {
        
       $rules =  [
        'm_to_s_morning_start' => ['required'],
        'm_to_s_morning_end' => ['required'],
        'm_to_s_evening_start' => ['required'],
        'm_to_s_evening_end' => ['required'],
        's_evening_start' => ['required'],
        's_evening_end' => ['required'],
        'facility' => ['required'],
        // 'meta_title' => ['required'],
        // 'meta_description' => ['required'],
        // 'meta_keyword' => ['required']
       ];

      
     
        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $userInformationObj = UserInformation::where('user_id',auth()->id())->first();
            $userInformationObj->m_to_s_morning_start = date("H:i", strtotime($request->m_to_s_morning_start));
            $userInformationObj->m_to_s_morning_end = date("H:i", strtotime($request->m_to_s_morning_end));
            $userInformationObj->m_to_s_evening_start = date("H:i", strtotime($request->m_to_s_evening_start));
            $userInformationObj->m_to_s_evening_end = date("H:i", strtotime($request->m_to_s_evening_end));
            $userInformationObj->s_evening_end = date("H:i", strtotime($request->s_evening_end));
            $userInformationObj->s_evening_start = date("H:i", strtotime($request->s_evening_start));

            $userInformationObj->facility = $request->facility;
            // $userInformationObj->meta_title = $request->meta_title;
            // $userInformationObj->meta_keyword = $request->meta_keyword;
            // $userInformationObj->meta_description = $request->meta_description;
           

            $userInformationObj->save();

            // $this->_uploadCertificate($request);
            // $this->uploadPhoto($request);

            flash('Update Successfully')->success()->important();
            return redirect("/extra-info");      
        }
        
    }

    public function MyFeedbacks(Request $request)
    {
        $this->data['title'] ='My Feedback'; 
        return view('my-feedback',$this->data);
    }

    public function MyFeedbackGrid(Request $request)
    {
        $fields = array(
            "id",
            "title",	
            "title",	
            "rating",	
            "description"	
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = Review::with('getPatient')->where('user_id',auth()->id());        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $status = $row->status === 1?"Yes":"No";
                
                $action =" <a href='#' data-id='$row->id' class='feedbackStatus'>$status</a>";
                $description = htmlspecialchars(str_replace("'","`",$row->description));
                $readMoreLink ="... <a href='#' data-message='".$description."' class='readMoreMessage'>Read More</a>";
              
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->getPatient->name,
	    			$row->title,
	    			$row->rating,
	    			str_limit($row->description,$limit = 20,$readMoreLink),
	    			$action
	    		);
	    	}
        }
        


        return response()->json($output);  
    }


 
    public function MyFeedbackStatusChange(Request $request)
    {
        $status = self::$ERROR;
        $message = 'Error!';
        
        $recordObj = Review::find($request->id);
        if(isset($recordObj->id)){
            $recordObj->status = $recordObj->status == 1?0:1;
            $recordObj->save();
            $status = self::$SUCCESS;
            $message = "Successfully Changes";
            
            $userObj =  User::find(auth()->id());
            $avgRating = Review::where('user_id',$userObj->id)->where('status',1)->avg('rating');
            $userObj->avg_rating = $avgRating;
            $userObj->save();
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);

    }

    
    public function MyQuestionStatusChange(Request $request)
    {
        $status = self::$ERROR;
        $message = 'Error!';
        
        $recordObj = Question::find($request->id);
        if(isset($recordObj->id)){
            $recordObj->status = $recordObj->status == 1?0:1;
            $recordObj->save();
            $status = self::$SUCCESS;
            $message = "Successfully Changes";
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);

    }
    
    
    public function MyQAGrid(Request $request)
    {
        $fields = array(
            "id",
            "title",	
            "answer",	
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = Question::where('user_id',auth()->id());        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $status = $row->status === 1?"Yes":"No";
                $action =" <a href='#' data-id='$row->id' class='qaStatus'>$status</a>";
                $question =htmlspecialchars(str_replace("'","`",$row->title));
                $description = '';
                $answer = '';
                $text = 'Write Answer';
                if(!empty($row->answer)){
                    $text = 'Edit Answer';
                    $description = "...".htmlspecialchars(str_replace("'","`",$row->answer));
                    $answer = htmlspecialchars(str_replace("'","`",$row->answer));
                }
                $editLink ="$description ...<a href='#' data-id='$row->id' data-question='".$question."'  data-answer='".$answer."' class='editAnswer'>$text</a>";
              
              
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->title,
	    			$editLink,
	    			$action
	    		);
	    	}
        }
        


        return response()->json($output);  
    }

    public function saveAnswer(Request $request)
    {
      $status = self::$ERROR;
      $message = 'Error ! please check';
      $rules = array(
         'id'=>'required',
         'answer'=>'required'
     );
     
     $validation = \Validator::make($request->all(),$rules);
     if($validation->fails()){
        $message = flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
     }
     else{

            $record = Question::where([
               'id'=>$request->id,
               'user_id'=>auth()->id()
            ])->first();
            if(isset($record->id)){
                $record->answer=$request->answer;
                $record->save();
                $status = self::$SUCCESS;
                $message = 'Successfully Updated';
            }
         
     }

     $result = array(
      'status'=>$status,
      'message'=>$message
    );
    return response()->json($result);  
    }


    public function changePassword(Request $request)
    {
       return view('change-password');
    }
 
    public function saveChangePassword(Request $request)
    {
        $rules = array(
            'old_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed']
        );
        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $userObj = User::find(auth()->id());
            if(Hash::check($request->old_password,$userObj->password)){
                $userObj->password = Hash::make($request->password);
                $userObj->save();
                flash(('Password Change Successfully'))->success()->important();
                return redirect("/change-password");
            }
            else{
                flash(('Old Password i not match'))->error()->important();
                return back()->withInput();
            }
        }
    }

    public function requestForMoney(Request $request)
    {
        $user = auth()->user();
        if(empty($user->razorpay_account_id)){
            flash('Please Add Bank Account')->error()->important();
            return back()->withInput(); 
        }
        else{
            $walletObj = Wallet::where([
                'user_id'=>auth()->id()
            ])->first();
            $amount = isset($walletObj->amount)?$walletObj->amount:0;
               
            if($amount < config('application.minimum_withdrawal_amount')){
                flash('Minimum limit go withdrawal is'.config('application.minimum_withdrawal_amount'))->error()->important();
                return back()->withInput(); 
            }

            $pay = new PaymentGateway();
            
            $output = $pay->directTransfers($user->razorpay_account_id,$amount);
            if($output['status'] == 'error'){
                flash($output['message'])->error()->important();
                return back()->withInput(); 
            }
            else{
                $walletTransObj = new WalletTrans();
                $walletTransObj->user_id = auth()->id();
                $walletTransObj->action_user_id = auth()->id();
                $walletTransObj->wallet_id = $walletObj->id; 
                $walletTransObj->before_total = $walletObj->amount; 
                $walletTransObj->amount = $request->totalAmount;
                $walletTransObj->after_total = 0;
                $walletTransObj->description = " withdrawal money $amount";
                $walletTransObj->payment_id = $output['id'];
                $walletTransObj->save();
      
                $walletObj->amount = 0;
                $walletObj->save();
                 
                flash(('withdrawal successfully done'))->success()->important();
                return redirect("/dashboard");
            }
        }
    }
    public function bankDetail(Request $request)
    {
        $user = auth()->user();
        return view('bank-detail',array('record'=>$user));
    }
    public function bankDetailSave(Request $request)
    {
        $rules = array(
            'ifsc_code' => ['required', 'string'],
            'beneficiary_name' => ['required', 'string'],
            'account_type' => ['required'],
            'account_number' => ['required']
        );
        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $user = auth()->user();
            $inputs = $request->only(['ifsc_code', 'beneficiary_name','account_type','account_number']);
            $bankType = config('application.bankType');
            $inputs['account_type'] = isset($bankType[$request->account_type])?$bankType[$request->account_type]:'';
            $pay = new PaymentGateway();
            $email = "$user->id@arogyarth.com";
            // $output = $pay->createAccount($email,$user->name,$inputs);
            // if($output['status'] == 'error'){
            //     flash($output['message'])->error()->important();
            //     return back()->withInput(); 
            // }
            // else{
                $userObj = User::find(auth()->id());
           //     $userObj->razorpay_account_id = $output['data'];
                $userObj->ifsc_code = $request->ifsc_code;
                $userObj->beneficiary_name = $request->beneficiary_name;
                $userObj->account_type = $request->account_type;
                $userObj->account_number = $request->account_number;
                $userObj->save();
                flash(('Bank Add Successfully'))->success()->important();
                return redirect("/dashboard");
           // }
        }
    }
}