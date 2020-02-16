<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Question;
use App\Models\Review;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UserInformation;
use App\Traits\DatatableGrid;
use App\Traits\OtpHandle;
use Illuminate\Http\Request;

class UserCommonController extends Controller{

    use DatatableGrid;
    use OtpHandle;

    public function __construct()
    {
        $this->_getSection();
    } 

    private function _getSection(){
        $currentSegment = request()->segment(2);
        $this->data['menu'] = $currentSegment;
        $this->data['current_segment'] = $currentSegment;
            
        switch ($currentSegment) {
            case 'permission_management':
                $this->data['title'] = 'Sub Admin';
                $this->data['pageView'] = 'admin.sub_admin';
                break;
            
            default:
               $this->data['title'] = 'User';
               $this->data['pageView'] = 'admin.user';
                break;
        }
    }

    public function index(Request $request)
    {
        return view($this->data['pageView'].'_list',$this->data);
    }

     public function edit(Request $request){
         $userObj = User::findOrFail($request->id); 
         $segment = $request->segment(2);
         $this->data['amenities']= Amenities::pluck('name','id')->toArray();
         $this->data['certificates']= $record = UserCertificate::where('user_id',$userObj->id)->get();
         if($userObj->hasRole(config('application.patient_role'))){
            $this->data['categories'] = array();    
         $this->data['categoryArr'] =  array(); 
         }
         else{
             $role_wih_category = array_flip(config('application.role_wih_category'));
             $role = $userObj->roles()->first();
             $this->_getCategory($role_wih_category[$role->name]);

         }

         $this->data['title'] = 'Edit '.ucfirst($segment);
         $this->data['record'] = $userObj;

         return view('admin.edit_user',$this->data);
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
     
    public function appointmentGrid(Request $request)
    {
        $fields = array(
            "id",
            "patient_name",	
            "patient_gender",	
            "date",	
            "code"	
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
        
        $this->query = Appointment::
        with('getUser')->
        where('user_id',$request->user_id)->OrWhere('patient_id',$request->user_id);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $userName = $row->patient_name;
                if($row->user_id != $request->user_id)
                {
                    $userName = isset($row->getUser->name)?$row->getUser->name:'';
                    
                }
                $each = array (
	    			$row->id,
	    			$userName
                );
                if($row->user_id == $request->user_id)
                {
                 $each[] = $row->patient_gender;
                }
                $each[] = $row->date_str;
                $each[] = $row->time;
                $each[] = $row->code;
                $output ['data'] [] = $each;
	    	}
        }
        


        return response()->json($output);  
    }
     
public function reviewsGrid(Request $request)
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
    	
        $this->query = Review::with('getPatient')->where('user_id',$request->user_id);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $status = $row->status === 1?"Yes":"No";
                
                $action =$status;
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
    	
        $this->query = Question::where('user_id',$request->user_id);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $status = $row->status === 1?"Yes":"No";
                $action =$status;
                $question =htmlspecialchars(str_replace("'","`",$row->title));
                $description = '';
                $answer = '';
                $text = 'Write Answer';
                if(!empty($row->answer)){
                    $text = 'Edit Answer';
                    $description = htmlspecialchars(str_replace("'","`",$row->answer));
                    $answer = htmlspecialchars(str_replace("'","`",$row->answer));
                }
                $editLink ="$description ...<a href='#'   data-message='".$answer."' class='readMoreMessage'>Read More</a>";
              
              
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

    public function saveUser(Request $request){
        
        $user = User::findOrFail($request->id);
        $request->redirectTo = 'administrator/'.$request->segment(2).'/list'; 
        $request->user_id = $user->id; 
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
            $segment = $request->redirectTo;
            $userObj = User::find($request->user_id);
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->id_proof_type = $request->id_proof_type;
            $userObj->id_proof = $request->id_proof;
            $userObj->gender = $request->gender;
            $userObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/".$segment);
    }

    public function doctorSave($request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'default_margin' => ['required','numeric','min:0','max:100'],
        'sub_category' => ['required','numeric'],
        'practice_since' => ['required','numeric'],
        'registration_number' => ['required','string'],
        'location' => ['required','string'],
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

         
            $segment = $request->redirectTo;
            $userObj = User::find($request->user_id);
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->default_percentage = $request->default_margin/100;
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
            
            $userInformationObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/".$segment);     
        }
        
    }
    

    public function hospitalSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'default_margin' => ['required','numeric','min:0','max:100'],
        'practice_since' => ['required','numeric'],
        'location' => ['required','string'],
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

        
            $segment = $request->redirectTo;
            $userObj = User::find($request->user_id);
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->default_percentage = $request->default_margin/100;
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
            $userInformationObj->save();

            flash('Update Successfully')->success()->important();
            return redirect("/".$segment);      
           
        }
        
    }

    public function ChangeStatus(Request $request)
    {
        $status = self::$ERROR;
        $message = 'Error!';
        
        $userId =$request->id;
        $userObj =  User::find($userId);
        if(isset($userObj->id)){
            $userObj->status = $userObj->status == 1?0:1;
            $userObj->save();
            $status = self::$SUCCESS;
            $message = "Successfully Changes";
            $userObj->save();
        }
        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);

    }


    
    public function labSave(Request $request)
    {
        
       $rules =  [
        'category' => ['required','numeric'],
        'default_margin' => ['required','numeric','min:0','max:100'],
        'practice_since' => ['required','numeric'],
        'location' => ['required','string'],
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

          
            $segment = $request->redirectTo;
            $userObj = User::find($request->user_id);
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->gender = $request->gender;
            $userObj->lat = $request->location_lat;
            $userObj->lng = $request->location_lng;
            $userObj->default_percentage = $request->default_margin/100;
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
            $userInformationObj->save();
            flash('Update Successfully')->success()->important();
            return redirect("/".$segment);      
                
        }
        
    }
  
    public function deleteUser(Request $request){
        $status = self::$ERROR;
        $message = 'User not found';
        
        $RecordObj = User::find($request->id);
        if(isset($RecordObj->id)){
            $RecordObj->delete();
            $status = self::$SUCCESS;
            $message = "User Deleted Successfully";
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);
    }

    public function changeMobileNumber(Request $request)
    {
        $this->data['record'] = User::findOrFail($request->id);
        return view('admin.change_mobile_number',$this->data);
    }

    public function sendChangeMobileNumber(Request $request)
    {
        $rules =  [
            'mobile_number' => ['required','numeric']    
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
                return $this->_sendChangeMobileOtp($request);
            }
    }

    private function _sendChangeMobileOtp($request)
    {
        $record = User::findOrFail($request->id);
        $mobile_number = $request->mobile_number; 
       
        $checkMobile = $this->checkMobile($request->mobile_number);
        $resent_opt_content = config('application.resent_opt_content');
        if(isset($checkMobile->id)){
            $status = self::$SUCCESS;
            $message = "Otp is resend";
            $this->sendOtp($checkMobile->mobile,$checkMobile->user_id,$resent_opt_content);
            $checkMobile->delete();
        }
        else{
            $this->sendOtp($mobile_number,$record->id,$resent_opt_content);
        }
        flash('Successfully send otp')->success()->important();
        return redirect("/administrator/change-mobile-number/$request->id/$mobile_number");  
    }


    public function changeMobileNumberOtp(Request $request)
    {
        $this->data['record'] = User::findOrFail($request->id);
        $this->data['mobile_number'] = $mobile_number = $request->mobile_number;
        return view('admin.change_mobile_number',$this->data);
    }

    public function changeMobileNumberSuccessfully(Request $request)
    {
        if($request->send_type == 'confirm_otp'){
            $checkMobile = $this->checkMobile($request->mobile_number);
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
                $user->contact_number = $request->mobile_number;
                $user->username = $request->mobile_number;
                $user->mobile_verified_at = \DB::raw('now()');
                $user->save();  
                $checkMobile->delete();
            } catch (\Throwable $th) {
                //throw $th;
            }
         
            flash('successfully changed number')->success()->important();
            return redirect('/administrator/change-mobile-number/'.$request->id);
        }
        else{
            return $this->_sendChangeMobileOtp($request);
        }
    }
}