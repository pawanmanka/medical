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
    	
        $this->query = Appointment::where('user_id',auth()->id());        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                
                $description = htmlspecialchars(str_replace("'","`",$row->description));
                $readMoreLink ="... <a href='#' data-message='".$description."' class='readMoreMessage'>Read More</a>";
              
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->patient_name,
	    			$row->patient_gender,
	    			$row->date_str,
	    			$row->time,
	    			$row->code,
	    			$row->code
	    		);
	    	}
        }
        


        return response()->json($output);  
    }

}