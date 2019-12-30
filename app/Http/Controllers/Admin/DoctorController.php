<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class DoctorController extends UserCommonController
{
    use DatatableGrid;
    
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Doctor';
        $this->data['pageView'] = 'admin.doctor';
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
    	
        $this->query = User::with([
            'getWallet'
        ])
        ->withCount('getUserRating')
        ->whereHas('roles',function($query){
            $query->whereIn('name',array(config('application.doctor_role')));
        });        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("administrator/patient/edit/$row->id");
                $action ='';
                if(auth()->user()->can('edit doctor')){
                $action .= "<a href='$editLink' class='btn btn-primary text-white'><i class='fa fa-pencil'></i></a> ";
                }
                if(auth()->user()->can('delete doctor')){
    			$action .= "<a data_id='$row->id' href='#' class='btn btn-danger deleteUser text-white'><i class='fa fa-trash'></i></a>";
                }
                $appointmentLink = "<a data_id='$row->id' href='#' >Click Here</a>";
                
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->name,
	    			$row->contact_number,
	    			$appointmentLink,
	    			$appointmentLink,
	    			$appointmentLink,
	    			'Free',
	    			$row->get_user_rating_count,
	    			0,
	    			!empty($row->getWallet)?$row->getWallet->amount:0,
	    			$action
	    		);
	    	}
        }
        
        return response()->json($output);  
    }


        

}