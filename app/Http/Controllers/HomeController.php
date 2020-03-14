<?php

namespace App\Http\Controllers;

use App\Library\PaymentGateway;
use App\Models\Category;
use App\Models\Page;
use App\Models\Question;
use App\Models\Review;
use App\Models\Amenities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    
       public function testing(Request $request)
    {
      Log::info('webhook');
      Log::info($request->all());

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
        $this->data['amenities'] = Amenities::pluck('name','id')->toArray();
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
       $request = request();
       $search = $request->all();
       
       $this->data['roles'] = array_flip($roles);
       $this->data['search'] = $request->all();
       $this->data['filterParams'] = $request->all(['location','type','category']); 

       if(!empty($request->category)){
         $categoryObj = Category::where('slug',$request->category)->first();
         $search['categoryId'] = isset($categoryObj->id)?$categoryObj->id:null; 
       }
       $distanceFlag = false;
       if(!empty($request->location_lng) && !empty($request->location_lat) && is_numeric($request->location_lng) && is_numeric($request->location_lat) ){
         $distanceFlag = true;
         $haversine = "users.*,((6371 * acos(cos(radians(" . $request->location_lat . ")) 
         * cos(radians(`lat`)) 
         * cos(radians(`lng`) 
         - radians(" . $request->location_lng . ")) 
         + sin(radians(" . $request->location_lat . ")) 
         * sin(radians(`lat`))))) AS distance";
       }
       else{
         $haversine = "users.*";
       }
    
       
       
       $userObj = User::selectRaw( $haversine)->whereHas('roles',function($query) use($roles){
         $query->whereIn('name',$roles);
       })
       ->when(!empty($search),function($query) use($search,$request){
            $query->whereHas('getUserInformation',function($query) use($search,$request){
               if(isset($search['categoryId'])){
                  $categoryId= $search['categoryId'];
                  if($request->type != 3){
                   
                     $query->where(function($categoryWhere) use($categoryId){
                        $categoryWhere->where('category',$categoryId)->whereOr('subcategory',$categoryId);
                     });
                  }
                
               }
               // if(isset($search['price'])){
               //    $price= $search['price'];
               //    $query->orderBy('actual_fee',$price);
               // }
               if(isset($search['amenities'])){
                  $amenities= $search['amenities'];
                  $query->whereHas('getAmenities',function($q) use($amenities){
                       $q->where('amenities.id',$amenities);  
                  });
               }
               if(isset($search['experience'])){
                  $experience= !empty($search['experience'])?$search['experience']:0;
                  $year = date('Y') - $experience;
                  $query->where('practice_since','<=',$year);
               }
            })->when(!empty($search),function($query) use($request,$search){
               $categoryId= isset($search['categoryId'])?$search['categoryId']:999999;
               if($request->type == 3){
                
                  $query->whereHas('getLabCategory',function($q) use($categoryId){
                     $q->where('catagories.id',$categoryId);  
                });
               }
            });   
       })
       ->with('getUserInformation')
       ->withCount(['getAppointmentCount'])
       ->whereNotNull('mobile_verified_at')
       ->where('status',0)
       ->when(!empty($request->gender),function($query) use($request){
         $query->where('gender',$request->gender);
       })
       ->when(!empty($request->rating),function($query) use($request){
         $query->where('avg_rating',$request->rating);
       })
       ->where('status',config('application.user_active_status'))
       ->when($distanceFlag,function($query){
         $query->orderBy('distance');
         })
       ->when(isset($search['price']),function($query) use($search){
           $query->join('user_information','user_information.user_id','users.id')->orderBy('user_information.actual_fee',$search['price']);
         })
       ->paginate(config('application.listing_item_limit'));
       $this->data['result'] = $userObj->items();
       $this->data['paging'] = $userObj;
       
    }

    public function questionHelpFull(Request $request){
      $status = self::$ERROR;
      $helpfull =$nothelpfull = 0;
      $userObj = User::where('slug',$request->seoname)->where('status',0)->first();
      if(isset($userObj->id)){
         $records =  Question::where('user_id',$userObj->id)->where('id',$request->id)->where('status',1)->first();
         if(isset($userObj->id)){
            $status = self::$SUCCESS; 
            if($request->status == 1){
               $records->helpfull = $records->helpfull+1;
            }
            else{
               $records->nothelpfull = $records->nothelpfull+1;
            }
            $records->save();
            $helpfull = $records->helpfull;
            $nothelpfull = $records->nothelpfull;
         }
         
      }
      $result = array(
         'status'=>$status,
         'helpfull'=>$helpfull,
         'nothelpfull'=>$nothelpfull,
         
       );
   
     return response()->json($result);
    }
    public function questionAndFeedback(Request $request)
    {
      $status = self::$ERROR;
      $output = '';
      $page = isset($request->offset)?$request->offset:0;
      $userObj = User::where('slug',$request->seoname)->where('status',0)->first();
      if(isset($userObj->id)){
         $status = self::$SUCCESS;
         $limit = config('application.question_feedback_item_limit');
         $offset = $page * $limit ;

         if($request->type == 'question'){
            $records =  Question::
            where('user_id',$userObj->id)
            ->where('status',1)
            ->offset($offset)->limit($limit)->get();
            foreach ($records as $key => $value) {
               $output.= \View::make('_question_item',array('item'=>$value))->render();
            }
         }
         else{
            $records =  Review::where('user_id',$userObj->id)->where('status',1)->offset($offset)->limit($limit)->get();
            foreach ($records as $key => $value) {
               $output.= \View::make('_review_item',array('item'=>$value))->render();
            }
         }
         $offset =  $page +1;
   }

      $result = array(
         'status'=>$status,
         'output'=>$output,
         'offset'=>$offset
       );
   
     return response()->json($result);
    }

    public function detail(Request $request)
    {
           
       $userObj = User::with([])
       ->withCount([  
          'getQuestions'=>function($query){$query->where('status',1);},
          'getUserRating'=>function($query){$query->where('status',1)->with('getPatient');}
       ])
       ->where('slug',$request->seoname)->where('status',0)->first();
     
       if(!isset($userObj->id)){
          abort(404);
       }
       $userObj->get_questions_count = ceil($userObj->get_questions_count/config('application.question_feedback_item_limit'));
       $userObj->get_user_rating_count = ceil($userObj->get_user_rating_count/config('application.question_feedback_item_limit'));
       if($userObj->role_name  == config('application.lab_role')){
        $services = array();       
        $packages = array();       
         if(!$userObj->getProducts->isEmpty()){
            foreach ($userObj->getProducts as $key => $value) {
                 foreach ($value->productItems as $index => $product) {
                    if($product->lab_product_type == 1){
                       $services[] = $product;
                    }
                    else{
                       $packages[] = $product;
                    }
                 }
            }
       }
       $this->data['services'] = $services;
       $this->data['packages'] = $packages;
      }

       $this->data['title'] = $userObj->name;
       $this->data['currentUser'] = $request->seoname;
       $this->data['record'] = $userObj;
       $this->data['userInformation'] = $userObj->getUserInformation;
       $this->data['userCertificate'] = $userObj->getUserCertificate;
       $this->data['userPhotos'] = $userObj->getUserPhoto;
  
       return view('detail',$this->data);
    }

    public function createReview(Request $request)
    {
      $status = self::$ERROR;
      $message = 'Error ! please check';
      $rules = array(
         'user_id'=>'required',
         'title'=>'required',
         'recommend'=>'required',
         'rating'=>'required',
         'description'=>'required'
     );
     
     $post = $request->all();
     $validation = \Validator::make($request->all(),$rules);
     if($validation->fails()){
        $message = flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
     }
     else{

         $userObj = User::where('slug',$request->user_id)->where('status',0)->first();
         if(isset($userObj->id)){
            $record = Review::firstOrCreate([
               'user_id'=>$userObj->id,
               'patient_id'=>auth()->id()
            ]);
   
            $record->title=$request->title;
            $record->recommend=$request->recommend;
            $record->rating=$request->rating;
            $record->description=$request->description;
            $record->save();
            $status = self::$SUCCESS;
            $message = 'Thank you for your Review';
         }
      
     }

     $result = array(
      'status'=>$status,
      'message'=>$message
    );

  return response()->json($result);
    }


    public function createQuestion(Request $request)
    {
      $status = self::$ERROR;
      $message = 'Error ! please check';
      $rules = array(
         'user_id'=>'required',
         'question'=>'required'
     );
     
     $post = $request->all();
     $validation = \Validator::make($request->all(),$rules);
     if($validation->fails()){
        $message = flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
     }
     else{

         $userObj = User::where('slug',$request->user_id)->where('status',0)->first();
         if(isset($userObj->id)){
            $record = new Question();
            $record->user_id=$userObj->id;
            $record->patient_id=auth()->id();
            $record->title=$request->question;
            $record->save();
            $status = self::$SUCCESS;
            $message = 'Thank you for your Question';
         }
      
     }

     $result = array(
      'status'=>$status,
      'message'=>$message
    );

  return response()->json($result);
    }


    public function getCategory(Request $request)
    {
       $category = $request->category;
       $result =$this->_getCategory($category);
       return response()->json($result);
    }
    private function _getCategory($superCategoryId){
      $categories = array(); 
      $categoryArr = array(); 
      $categoryObj =  Category::with('getSubCategory')->where('parent_id',0)->where('super_category_id',$superCategoryId)->get();
       foreach ($categoryObj as $key => $category) {
           $categoryArr[$category->slug] =  $category->name;
           if(!empty($category->getSubCategory)){
              foreach ($category->getSubCategory as $key => $value) {
                 $categoryArr[$value->slug] =  $category->name.'->'.$value->name;
              }
           }
       }  
       return  $categoryArr;;   
  }
}
