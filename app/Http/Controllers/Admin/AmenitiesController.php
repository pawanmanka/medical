<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\UserAmenities;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    use DatatableGrid;
    
    public function __construct()
    {
        $this->data['menu'] = 'amenities';
    }

    public function index(){
        $this->data['subMenu'] = 'amenities_list';
        return view('admin.amenities_list',$this->data);
    }

    public function add(Request $request){
        $this->data['subMenu'] = 'amenities_add';
        return view('admin.amenities_add_edit',$this->data);       
    }



    public function edit(Request $request){
        $amenitiesObj = Amenities::find($request->id);
        $this->data['subMenu'] = 'amenities_add';
        $this->data['amenities'] = $amenitiesObj;
        return view('admin.amenities_add_edit',$this->data);       
    }

    public function save(Request $request){
        $id = $request->id;
        $rules = array(
            'name'=>'required'
        );
      
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
          
             flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
             return back()->withInput(); 
        }
        else{
            $amenitiesObj = !empty($id)?Amenities::find($id):new Amenities();
            $amenitiesObj->name = $request->name;
            $amenitiesObj->save();
            flash('Amenities Save Successfully')->success()->important();
            return redirect('/administrator/amenities/list');
        }
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
    	
        $this->query = Amenities::where('id','!=',0);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/amenities/edit/$row->id");
                $action ='';
                if(auth()->user()->can('edit amenities')){
                $action .= "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
                }
               if(auth()->user()->can('delete amenities')){
                $action .= "<a data_id='$row->id' href='#' class='btn btn-danger deleteAmenities text-white'><i class='fa fa-trash'></i></a>";
                }
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->name,
	    			$action
	    		);
	    	}
        }
        


        return response()->json($output);  
    }
    

    public function delete(Request $request)
    {
        $status = self::$ERROR;
        $message = 'amenities not found';
        
        $amenitiesObj =  Amenities::find($request->id);
        if(isset($amenitiesObj->id)){
            $resultObj =  UserAmenities::whereAmenitieId($amenitiesObj->id)->first();
            if(empty($resultObj->id)){
                $amenitiesObj->delete();
                $status = self::$SUCCESS;
                $message = "Amenities Deleted Successfully";
            }
            else{
                $message = "Amenities not deleted because it linked to user";
            }
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);
    }
}
