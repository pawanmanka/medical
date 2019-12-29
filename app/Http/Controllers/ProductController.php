<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductItem;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use DatatableGrid;
    public function __construct()
    {
        $this->data = array();
    }    

    public function doctorProducts(Request $request)
    {
        $this->data['title'] ='Choose Calendar'; 
        return view('doctor_product_list',$this->data);
    }

    public function grid(Request $request){
        $user = auth()->user();
       if($user->hasRole(config('application.doctor_role'))){
            $output = $this->_doctorGrid();
       }
    //    else if($user->hasRole(config('application.hospital_role'))){
    //     $output = $this->_doctorGrid();
    //    }
       else if($user->hasRole(config('application.lab_role'))){
        $output = $this->_tabGrid($request);
       }
       else{
          abort(404);
       }
        
        


        return response()->json($output);  
    }

    private function _doctorGrid(){
        $fields = array(
            "id",
            "name"
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = Product::where('type',Product::$DOCTOR)->where('user_id',auth()->id());        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("create-slots/$row->id");
    			$action = "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil-alt'></i></a> ";
                
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->name,
	    			$action
	    		);
	    	}
        }
        return $output;
    }
    
    private function _tabGrid($request){
        $segment = $request->segment(1);
        $type = $segment == 'my-packages'?2:1;
        $fields = array(
            "product_id ",
            "name",
            "actual_price",
            "discount_price"
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = ProductItem::where('lab_product_type',$type)->whereHas('getProduct',function($query){
            $query->where('type',Product::$LAB)->where('user_id',auth()->id());        
        });
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("$segment/edit/$row->product_id");
    			$action = "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil-alt'></i></a> ";
                
                $output ['data'] [] = array (
	    			$row->product_id,
	    			$row->name,
	    			$row->actual_price,
	    			$row->discount_price,
	    			$action
	    		);
	    	}
        }
        return $output;
    }
    
    public function createSlots(Request $request)
    {
        $this->data['title'] = !isset($request->id)?'Create Slot':'Edit Slot';
        if(isset($request->id)){
            $productObj = Product::whereId($request->id)->whereUserId(auth()->id())->first();
            if(!isset($productObj->id)){
                abort(404);
            }
            $this->data['record'] = $productObj;
        } 
        return view('create_slot',$this->data);
    }

    public function slotSave(Request $request){
        $rules = array(
            'date'=>'required',
            'time_start'=>'required',
            'time_end'=>'required'
        );
        $slots ='';
        $post = $request->all();
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
            flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $date = date('Y-m-d',strtotime($request->date));
            $time_start = strtotime($request->time_start);
            $time_end = strtotime($request->time_end);
            if($time_start < $time_end){ 
               $productObj  = Product::firstOrCreate([
                    'name'=>$date,
                    'date'=>$date,
                    'user_id'=>auth()->id()
                   ]);
                   
                $productObj->type  = Product::$DOCTOR;
                $productObj->time_start  = date('H:i',$time_start);
                $productObj->time_end  = date('H:i',$time_end);
                $productObj->save();

                foreach ($request->actual_fee as $timestamp => $value) {
                    $productItemObj  = ProductItem::firstOrCreate([
                        'product_id'=>$productObj->id,
                        'name'=>$timestamp
                    ]);
                    if(empty($productItemObj->code)){
                        $productItemObj->code =  $productItemObj->generateUniqueCode();
                    }
                    $productItemObj->actual_price=$value;
                    $productItemObj->discount_price=isset($request->discount_fee[$timestamp])?$request->discount_fee[$timestamp]:0;
                    $productItemObj->save();
                }    

                flash('Update Successfully')->success()->important();
                return redirect("/choose-calendar-option");      

            }
            else{
                flash('End Time Grater than Start time')->error()->important();
                return back()->withInput(); 
            }
        }
    }
    public function getSlots(Request $request)
    {
        $status = self::$ERROR;
        $rules = array(
            'date'=>'required',
            'time_start'=>'required',
            'time_end'=>'required'
        );
        $slots ='';
        $post = $request->all();
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
            $message =   makeErrorMessage($validation->errors()->messages());
        }
        else{
           $time_start = strtotime($request->time_start);
           $time_end = strtotime($request->time_end);
           if($time_start < $time_end){
              $oldItems = array();  
            $diff = $time_end - $time_start;
              $time = round($diff/600);
              $diffTime = $diff%600;
              $date_time_start = "$request->date $request->time_start";
              $date_time_start_value = date('Y-m-d',strtotime($date_time_start));
              $time_start_value = strtotime($date_time_start);
              $date = date('Y-m-d',strtotime($request->date));
              $productObj = Product::where('date',$date)->whereUserId(auth()->id())->first();
              if(isset($productObj->id)){
                  $productItems = $productObj->productItems()->get();
                  foreach ($productItems as $key => $value) {
                    $oldItems[$value->name] = $value;
                  }
              }
              $user = auth()->user()->getUserInformation;
              $dataArr = array(
                  'time'=> date("h:i A", $time_start_value),
                  'price'=>isset($oldItems[$time_start_value])?$oldItems[$time_start_value]->actual_price:$user->actual_fee,
                  'discount_fee'=>isset($oldItems[$time_start_value])?$oldItems[$time_start_value]->discount_price:$user->discount_price,
                  'availability'=>isset($oldItems[$time_start_value])?$oldItems[$time_start_value]->status:'1',
                  'index'=>isset($oldItems[$time_start_value])?$oldItems[$time_start_value]->name:$time_start_value
                );
              $slots.= \View::make('_slot',$dataArr)->render();
              for($i=1;$i < $time;$i++){
                 $time_start_value =  $time_start_value+600;
                 $dataArr = array(
                    'time'=> date("h:i A", $time_start_value),
                    'price'=>isset($oldItems[$time_start_value])?$oldItems[$time_start_value]->actual_price:$user->actual_fee,
                    'discount_fee'=>isset($oldItems[$time_start_value])?$oldItems[$time_start_value]->discount_price:$user->discount_price,
                    'availability'=>isset($oldItems[$time_start_value])?$oldItems[$time_start_value]->status:'1',
                    'index'=>$time_start_value
                  );
                 //$dataArr['index'] = $time_start_value;
                 $slots.= \View::make('_slot',$dataArr)->render();
              }
              $message =  "Slots";
              $status = self::$SUCCESS;
           }
           else{
            $message =  "End Time Grater than Start time";
           }
        }
        $result = array(
            'status'=>$status,
            'message'=>$message,
            'slots'=>$slots,  
            'post'=>$post,  
        );

        return response()->json($result);
    }


    public function labProducts(Request $request){
        $segment = $request->segment(1);
      
        $this->data['title'] = ucfirst(str_replace('-',' ',$segment)); 
        $this->data['addUrl'] ="$segment/add"; 
        $this->data['gridUrl'] =url("$segment/grid"); 
        return view('lab_product_list',$this->data);
    }
  
    public function labProductAdd(Request $request){
        $segment = $request->segment(1);
        $id = $request->id;
        $this->data['title'] = 'Add '.ucfirst(str_replace('-',' ',$segment)); 
        if(!empty($id)){
            $productObj  = Product::findOrFail($id);
            $this->data['record'] = $productObj->productItems->first();
            $this->data['title'] = 'Edit '.ucfirst(str_replace('-',' ',$segment)); 
            
        }
        $this->data['segment'] =$segment;
        return view('lab_product_add',$this->data);
    }
 
    public function labProductSave(Request $request){
        $segment = $request->segment(1);
        $id = $request->id;

        $rules =  [
            'name' => ['required'],
            'actual_fee' => ['required'],
            'discount_fee' => ['required']
           ];
        if($segment =='my-packages'){
            $rules['description'] =  ['required'];
        }   

        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{

            $productObj  = !empty($id)?Product::findOrFail($id):new Product();
            $productObj->type  = Product::$LAB;  
            $productObj->name  = $request->name;
            $productObj->user_id  =  auth()->id();
            $productObj->save();

            $productItems = $productObj->productItems->first();
            $type = $segment == 'my-packages'?2:1;
            $productItemObj  = isset($productItems->id)?$productItems:new ProductItem();
            $productItemObj->product_id=$productObj->id;
            $productItemObj->name=$request->name;
            if(empty($productItemObj->code)){
                $productItemObj->code =  $productItemObj->generateUniqueCode();
            }
            if($segment =='my-packages'){
            $productItemObj->description=$request->description;
            }
            $productItemObj->lab_product_type=$type;
            $productItemObj->actual_price=$request->actual_fee;
            $productItemObj->discount_price=$request->discount_fee;
            $productItemObj->save();

            flash('Update Successfully')->success()->important();
            return redirect("/$segment");   
        }
    }

}