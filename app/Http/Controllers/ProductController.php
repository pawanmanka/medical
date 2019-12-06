<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
        $fields = array(
            "id",
            "name"
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = Products::where('id','!=',0);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/category/edit/$row->id");
    			$action = "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
    			$action .= "<a data_id='$row->id' href='#' class='btn btn-danger deleteCategory text-white'><i class='fa fa-trash'></i></a>";
                
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->name,
	    			$action
	    		);
	    	}
        }
        


        return response()->json($output);  
    }
    
    public function createSlots(Request $request)
    {
        $this->data['title'] ='Create Slot'; 
        return view('create_slot',$this->data);
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
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
            $message =   makeErrorMessage($validation->errors()->messages());
        }
        else{
           $time_start = strtotime($request->time_start);
           $time_end = strtotime($request->time_end);
           if($time_start < $time_end){
              $diff = $time_end - $time_start;
              $time = round($diff/600);
              $diffTime = $diff%600;
              $time_start_value = $time_start;
              $dataArr = array(
                  'time'=> date("h:i A", $time_start_value),
                  'price'=>'200',
                  'index'=>$time_start_value
                );
              $slots.= \View::make('_slot',$dataArr)->render();
              for($i=1;$i < $time;$i++){
                 $time_start_value =  $time_start_value+600;
                 $dataArr['index'] = $time_start_value;
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
            'slots'=>$slots
        );

        return response()->json($result);
    }
}