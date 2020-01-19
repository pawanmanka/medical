<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    use DatatableGrid;
    
    public function __construct()
    {
        $this->data['menu'] = 'plans';
    }

    public function index(){
        $this->data['subMenu'] = 'plans_list';
        return view('admin.plans_list',$this->data);
    }

    public function add(Request $request){
        $this->data['subMenu'] = 'plans_add';
        return view('admin.plans_add_edit',$this->data);       
    }



    public function edit(Request $request){
        $plansObj = Plan::find($request->id);
        $this->data['subMenu'] = 'plans_add';
        $this->data['record'] = $plansObj;
        return view('admin.plans_add_edit',$this->data);       
    }

    public function save(Request $request){
        $id = $request->id;
        $rules = array(
            'name'=>'required',
            'price'=>'required|numeric',
        );
      
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
          
             flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
             return back()->withInput(); 
        }
        else{
            $plansObj = !empty($id)?Plan::find($id):new Plan();
            $plansObj->name = $request->name;
            $plansObj->price = $request->price;
            $plansObj->save();
            flash('Plans Save Successfully')->success()->important();
            return redirect('/administrator/plans/list');
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
    	
        $this->query = Plan::where('id','!=',0);        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/plans/edit/$row->id");
                $action ='';
                if(auth()->user()->can('edit plans')){
                $action .= "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
                }
               if(auth()->user()->can('delete plans')){
                $action .= "<a data_id='$row->id' href='#' class='btn btn-danger deletePlans text-white'><i class='fa fa-trash'></i></a>";
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
        $message = 'plans not found';
        
        $plansObj =  Plan::find($request->id);
        if(isset($plansObj->id)){
            $resultObj =  User::wherePlanId($plansObj->id)->first();
            if(empty($resultObj->id)){
                $plansObj->delete();
                $status = self::$SUCCESS;
                $message = "Plans Deleted Successfully";
            }
            else{
                $message = "Plans not deleted because it linked to user";
            }
        }
        

        $result = array(
            'status'=>$status,
            'message'=>$message
        );

        return response()->json($result);
    }
}
