<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class PatientController extends UserCommonController
{
    use DatatableGrid;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Patient';
        $this->data['pageView'] = 'admin.patient';
    } 



    public function index(Request $request)
    {
        return view($this->data['pageView'].'_list',$this->data);
    }

    public function grid(Request $request){
        $fields = array(
            "id",
            "name",	
            "contact_number",
            "email"	,
            "id_proof"	,
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = User::with('getWallet')->whereHas('roles',function($query){
            $query->whereIn('name',array(config('application.patient_role')));
        });        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $action ='';
                $editLink = url("administrator/change-mobile-number/$row->id");
    			$action .= "<a href='$editLink' title='change mobile number' class='btn btn-primary text-white'><i class='fa fa-repeat'></i></a> ";
                $editLink = url("administrator/patient/edit/$row->id");
                if(auth()->user()->can('edit patient')){
    			$action .= "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
                }
                 if(auth()->user()->can('delete patient')){
                $action .= "<a data_id='$row->id' href='#' class='btn btn-danger deleteUser text-white'><i class='fa fa-trash'></i></a>";
                }
                
                    $each = array (
	    			$row->id,
	    			$row->name,
	    			$row->contact_number,
	    			$row->email,
	    			$row->id_proof,
	    			'Free',
	    			!empty($row->getWallet)?$row->getWallet->amount:0
                );
                if(auth()->user()->can('edit doctor')){
                    $status = $row->status == 0?'Yes':'No';  
                    $each[] = "<a class='changeStatus' data_id='$row->id' href='#' >$status</a>";
                  }
                  $each[] =$action;
                  $output ['data'] [] =$each;
	    	}
        }
        
        return response()->json($output);  
    }


        

}