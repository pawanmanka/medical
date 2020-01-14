<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use DatatableGrid;
    
    public function __construct()
    {
        $this->data['title'] = 'Appointment';
    }

    public function index(Request $request)
    {
        return view('appointments',$this->data);
    }

    public function grid(Request $request)
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
        $fieldName = 'user_id';
        $actionButton = true;
        if(auth()->user()->hasRole(config('application.patient_role')))
        {
            $actionButton = false;
            $fieldName = 'patient_id';
      
        }
        $this->query = Appointment::with('getUser')
        ->where($fieldName,auth()->id());        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
             
                $userName = $row->patient_name;
                if($row->user_id != auth()->id())
                {
                    $userName = isset($row->getUser->name)?$row->getUser->name:'';
                    
                }
              
                
                $each = array (
	    			$row->id,
	    			$userName
                );
                if($row->user_id == auth()->id())
                {
                 $each[] = $row->patient_gender;
                }
                $each[] = $row->date_str;
                $each[] = $row->time;
                $each[] = $row->code;
                if($actionButton){
                    if($row->status == Appointment::$STATUS_CANCEL){
                        $action ='Canceled';
                    }
                    else{
                        $action ="<a href='#' class='cancelAppointment' data-href='".url('appointment/cancel/'.$row->code)."'> Cancel <a>";
                    }
                    $each[] = $action;
                }
                $output ['data'] [] = $each;
	    	}
        }
        


        return response()->json($output);  
    }

   public function cancel(Request $request)
   {
              
    $query = Appointment::where('user_id',auth()->id())->where('code',$request->code)->first();
    if(!isset($query->id)) abort(404);
    if($query->status == Appointment::$STATUS_CANCEL) 
    {
        flash('Appointment Already Canceled')->error()->important();
        return back();
    } 
  
    $query->status = Appointment::$STATUS_CANCEL;
    $query->save();
    flash('Appointment  Canceled')->success()->important();
    return back();


   }

}