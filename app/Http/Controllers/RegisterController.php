<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UserInformation;
use App\Traits\OtpHandle;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller{
 
     use OtpHandle;
     use UploadImage;

     public function __construct()
    {
        $this->middleware('guest');
       $this->data = array();
    }


    public function patient(Request $request)
    {
        return view('patient_register');
    }

    public function patientSave(Request $request)
    {
       $validatorObj =   \Validator::make($request->all(), [
            'password' => ['required'],
            'contact_number' => ['required', 'string','max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed']
        ]);

        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $userObj = new User();

            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->username = $request->contact_number;
            $userObj->contact_number = $request->contact_number;
            $userObj->id_proof_type = $request->id_proof_type;
            $userObj->id_proof = $request->id_proof;
            $userObj->gender = $request->gender;
            $userObj->plan_id = $request->plan_id;
            $userObj->password = Hash::make($request->password) ;
            $userObj->save();

            $role_r = Role::where('name', '=',config('application.patient_role'))->firstOrFail();            
            $userObj->assignRole($role_r);
            $this->sendOtp($userObj->contact_number,$userObj->id,config('application.register_sms_content'));
            flash('Registration Successfully')->success()->important();
            return redirect("/verifyOtp/$userObj->contact_number");       
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

    public function doctor(Request $request)
    {
        $this->_getCategory(Category::$DOCTOR);
        return view('doctor_register',$this->data);
    }



    public function doctorSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'sub_category' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'registration_number' => ['required','string'],
        'location' => ['required','string'],
        'hospital' => ['required','string'],
        'qualification' => ['required','string'],
        'contact_number' => ['required', 'string','max:255', 'unique:users'],
        'email' => ['required', 'string','max:255'],
        'profile_image' => ['required','image','mimes:'.config('application.valid_image_mimes')],
        'password' => ['required', 'string', 'confirmed'],
        'certificate' => ['required'],
        'certificate.*' => ['image','mimes:'.config('application.valid_image_mimes')],
       ];
     
        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){

            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{

          
            $userObj = new User();

            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->username = $request->contact_number;
            $userObj->contact_number = $request->contact_number;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->plan_id = $request->plan_id;
            $userObj->default_percentage = config('application.default_percentage');
            $userObj->password = Hash::make($request->password) ;
            $userObj->save();
           
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();

            // user information

            $userInformationObj = new UserInformation();
            $userInformationObj->category = $request->category;
            $userInformationObj->sub_category = $request->sub_category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->registration_number = $request->registration_number;
            $userInformationObj->address = $request->location;
           
            $userInformationObj->hospital = $request->hospital;
            $userInformationObj->qualification = $request->qualification;
            $userInformationObj->doctor_education = $request->qualification;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),null,'profile_image');
            }
            $userInformationObj->save();

           
            
            $this->_uploadCertificate($request->certificate,$userObj->id);

            $role_r = Role::where('name', '=',config('application.doctor_role'))->firstOrFail();            
            $userObj->assignRole($role_r);
            $this->sendOtp($userObj->contact_number,$userObj->id,config('application.register_sms_content'));
            flash('Registration Successfully')->success()->important();
            return redirect("/verifyOtp/$userObj->contact_number");      
        }
        
    }

    public function verifyOtp(Request $request)
    {
        $checkMobile = $this->checkMobile($request->mobile);
        if(!isset($checkMobile->id)){
            abort(404);
        }
        $this->data['mobile'] = $request->mobile;
        return view('verify_register_otp',$this->data);
    }
    

    public function verifyOtpData(Request $request)
    {
        $checkMobile = $this->checkMobile($request->mobile);
        if(!isset($checkMobile->id)){
            flash('Mobile Number Not Found')->error()->important();
            return back()->withInput(); 
        }
        if($checkMobile->token != $request->otp){
            flash('Otp not valid')->error()->important();
            return back()->withInput(); 
        }
        try {
            $user = User::find($checkMobile->user_id);
            $user->mobile_verified_at = \DB::raw('now()');
            $user->save();  
            $checkMobile->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
     
        flash('Otp verify successfully ')->success()->important();
        return redirect('/register');
    }
    
    public function resendVerifyOtp(Request $request)
    {
        $status = self::$ERROR;
        $message = "Mobile number not found";
        $checkMobile = $this->checkMobile($request->mobile);
        if(isset($checkMobile->id)){
            $status = self::$SUCCESS;
            $message = "Otp is resend";
            $this->sendOtp($checkMobile->mobile,$checkMobile->user_id,config('application.register_sms_content'));
            $checkMobile->delete();
        }
        $result = array(
            'status'=>$status,
            'message'=>$message
        );
        return response()->json($result);
    }

    public function hospital(Request $request)
    {
        $this->_getCategory(Category::$HOSPITAL);
        return view('hospital_register',$this->data);
    }



    public function hospitalSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'location' => ['required','string'],
        'contact_number' => ['required', 'string','max:255', 'unique:users'],
        'email' => ['required', 'string','max:255', 'unique:users'],
        'profile_image' => ['required','image','mimes:'.config('application.valid_image_mimes')],
        'password' => ['required', 'string', 'confirmed'],
        'certificate' => ['required'],
        'certificate.*' => ['image','mimes:'.config('application.valid_image_mimes')],
       ];
        if(isset($request->certificate)){
              foreach ($request->certificate as $key => $certificate) {
                $rules['certificate'.$key] = 'image|mimes:'.config('application.valid_image_mimes');
              }
        }
        else{
            $rules['certificate'] = 'image|mimes:'.config('application.valid_image_mimes');   
        }

        $validatorObj =   \Validator::make($request->all(),$rules);

        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{

          
            $userObj = new User();

            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->username = $request->contact_number;
            $userObj->contact_number = $request->contact_number;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->plan_id = $request->plan_id;
            $userObj->default_percentage = config('application.default_percentage');

            $userObj->password = Hash::make($request->password) ;
            $userObj->save();
           
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();

            // user information

            $userInformationObj = new UserInformation();
            $userInformationObj->category = $request->category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->address = $request->location;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),null,'profile_image');
            }
            $userInformationObj->save();

           
            // 
            $this->_uploadCertificate($request->certificate,$userObj->id);

            $role_r = Role::where('name', '=',config('application.hospital_role'))->firstOrFail();            
            $userObj->assignRole($role_r);
            $this->sendOtp($userObj->contact_number,$userObj->id,config('application.register_sms_content'));
            flash('Registration Successfully')->success()->important();
            return redirect("/verifyOtp/$userObj->contact_number");   
        }
        
    }


    public function lab(Request $request)
    {
        $this->_getCategory(Category::$LAB);
        return view('lab_register',$this->data);
    }



    public function labSave(Request $request)
    {
     
       $rules =  [
        'category' => ['required'],
        'category.*' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'location' => ['required','string'],
        'contact_number' => ['required', 'string','max:255', 'unique:users'],
        'email' => ['required', 'string','max:255', 'unique:users'],
        'profile_image' =>  ['required','image','mimes:'.config('application.valid_image_mimes')],
        'password' => ['required', 'string', 'confirmed'],
        'certificate' => ['required'],
        'certificate.*' => ['image','mimes:'.config('application.valid_image_mimes')],
       ];
     

        $validatorObj =   \Validator::make($request->all(),$rules);

        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
          //  dd($request->all());
          
            $userObj = new User();

            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->username = $request->contact_number;
            $userObj->contact_number = $request->contact_number;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->plan_id = $request->plan_id;
            $userObj->default_percentage = config('application.default_percentage');

            $userObj->password = Hash::make($request->password) ;
            $userObj->save();
           
            $userObj->slug = str_slug($userObj->name)."-$userObj->id" ;
            $userObj->save();

            //getLabCategory
            $userObj->getLabCategory()->sync($request->category);
            // user information

            $userInformationObj = new UserInformation();
           // $userInformationObj->category = $request->category;
            $userInformationObj->practice_since = $request->practice_since;
            $userInformationObj->address = $request->location;
            $userInformationObj->user_id = $userObj->id;
            if($request->hasFile('profile_image')) {
                $userInformationObj->profile_image =   $this->fileUpload($request,config('application.users_image_path'),null,'profile_image');
            }
            $userInformationObj->save();

           
            // 

            $role_r = Role::where('name', '=',config('application.lab_role'))->firstOrFail();            
            $userObj->assignRole($role_r);
            $this->sendOtp($userObj->contact_number,$userObj->id,config('application.register_sms_content'));
            flash('Registration Successfully')->success()->important();
            return redirect("/verifyOtp/$userObj->contact_number");       
        }
        
    }

     
    public function _uploadCertificate($certificates,$userId)
    {
        foreach ($certificates as $key => $certificate) {
            $userCertificateObj = new UserCertificate();
            $userCertificateObj->file_name =  $this->fileUploadFile($certificate,config('application.certificate_image_path'));
            $userCertificateObj->user_id = $userId;
            $userCertificateObj->save();
        }

    }


}