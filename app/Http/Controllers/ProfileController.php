<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\UserInformation;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class ProfileController extends Controller{
    use UploadImage;

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
        $role_wih_category = array_flip(config('application.role_wih_category'));
        $this->data['record'] =$user; 
      
        $this->_getCategory($role_wih_category[$role->name]);
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
        'address' => ['required','string'],
        'hospital' => ['required','string'],
        'qualification' => ['required','string'],
        'email' => ['required', 'string','max:255']
        
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
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();


            $userInformationObj = UserInformation::where('user_id',$userObj->id)->first();
            $userInformationObj->category = $request->category;
            $userInformationObj->sub_category = $request->sub_category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->registration_number = $request->registration_number;
            $userInformationObj->address = $request->address;
            $userInformationObj->hospital = $request->hospital;
            $userInformationObj->qualification = $request->qualification;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $oldImage = config('application.users_image_path').'/'.$userInformationObj->profile_image;
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),$oldImage,'profile_image');
            }
            
            $userInformationObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/profile");      
        }
        
    }
    

    public function hospitalSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'address' => ['required','string'],
        'email' => ['required', 'string','max:255']
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
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();
            

            // user information

            $userInformationObj = UserInformation::where('user_id',$userObj->id)->first();
            $userInformationObj->category = $request->category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->address = $request->address;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $oldImage = config('application.users_image_path').'/'.$userInformationObj->profile_image;
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),$oldImage,'profile_image');
            }
            $userInformationObj->save();

            flash('Update Successfully')->success()->important();
            return redirect("/profile");    
           
        }
        
    }

    
    public function labSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'address' => ['required','string'],
        'email' => ['required', 'string','max:255']
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
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();

            // user information

            $userInformationObj = UserInformation::where('user_id',$userObj->id)->first();
            $userInformationObj->category = $request->category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->address = $request->address;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $oldImage = config('application.users_image_path').'/'.$userInformationObj->profile_image;
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),$oldImage,'profile_image');
            }
            $userInformationObj->save();
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
        $this->data['record']= UserInformation::where('user_id',auth()->id())->first();
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
        'm_to_s_morning_start' => ['required'],
        'm_to_s_morning_end' => ['required'],
        'm_to_s_evening_start' => ['required'],
        'm_to_s_evening_end' => ['required'],
        's_evening_start' => ['required'],
        's_evening_end' => ['required'],
        'actual_fee' => ['required'],
        'discounted_fee' => ['required'],
        'meta_title' => ['required'],
        'meta_description' => ['required'],
        'meta_keyword' => ['required']
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
            $userInformationObj->m_to_s_morning_start = date("H:i", strtotime($request->m_to_s_morning_start));
            $userInformationObj->m_to_s_morning_end = date("H:i", strtotime($request->m_to_s_morning_end));
            $userInformationObj->m_to_s_evening_start = date("H:i", strtotime($request->m_to_s_evening_start));
            $userInformationObj->m_to_s_evening_end = date("H:i", strtotime($request->m_to_s_evening_end));
            $userInformationObj->s_evening_end = date("H:i", strtotime($request->s_evening_end));
            $userInformationObj->s_evening_start = date("H:i", strtotime($request->s_evening_start));

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
            
            $userInformationObj->actual_fee = $request->actual_fee;
            $userInformationObj->discounted_fee = $request->discounted_fee;
            $userInformationObj->meta_title = $request->meta_title;
            $userInformationObj->meta_keyword = $request->meta_keyword;
            $userInformationObj->meta_description = $request->meta_description;
           

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
        'meta_title' => ['required'],
        'meta_description' => ['required'],
        'meta_keyword' => ['required']
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
            $userInformationObj->meta_title = $request->meta_title;
            $userInformationObj->meta_keyword = $request->meta_keyword;
            $userInformationObj->meta_description = $request->meta_description;
           

            $userInformationObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/extra-info");      
        }
        
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
        'meta_title' => ['required'],
        'meta_description' => ['required'],
        'meta_keyword' => ['required']
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
            $userInformationObj->meta_title = $request->meta_title;
            $userInformationObj->meta_keyword = $request->meta_keyword;
            $userInformationObj->meta_description = $request->meta_description;
           

            $userInformationObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/extra-info");      
        }
        
    }

}