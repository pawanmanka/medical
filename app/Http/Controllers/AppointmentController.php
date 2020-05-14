<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ProductItem;
use App\Traits\DatatableGrid;
use App\Traits\OtpHandle;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use DatatableGrid;
    use OtpHandle;

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
        $this->query = Appointment::with(['getUser','getAppointmentCancelUser'])
        ->where($fieldName,auth()->id());        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
             
                $userName = $row->patient_name;
                if($row->user_id != auth()->id())
                {
                    $getUser = $row->getUser;
                    if(isset($getUser->id)){
                        $userName = isset($getUser->name)?$getUser->name:'';
                        $userName = "<a target='_blank' href='$getUser->detail_url'>$userName</a>";

                    }
                    
                }
               $price = $actionButton?"<discount>".$row->price."</discount> ".$row->discount_price:$row->price; 
               
                
                $each = array (
	    			$row->id,
	    			$userName
                );
                if(!auth()->user()->hasRole(config('application.doctor_role')))
                    {
                        $getUser = $row->getUser;
                        if(isset($getUser->role_name) && $getUser->role_name  != config('application.doctor_role')){
                            $labBooking = isset($row->getProductItem->lab_product_type) && $row->getProductItem->lab_product_type >0?($row->getProductItem->lab_product_type==1?'(Service)':'(Package)'):'';
                            $bookingFor = isset($row->getProductItem->name)?$row->getProductItem->name." ".$labBooking:'';
                            $each[] = $bookingFor;
                        }  
                        else{
                            $each[] = '-';
                        }
                    }
                if($row->user_id == auth()->id())
                {
                 $each[] = $row->patient_gender;
                }
                $each[] = $row->date_str;
                $each[] = $row->time;
                $each[] = $row->code;
                $each[] = $price;
               // if($actionButton){
                    if($row->status == Appointment::$STATUS_CANCEL){
                        $canceledUser = auth()->id()== $row->cancel_by_user?'You':$row->getAppointmentCancelUser->name;
                        $action ="Canceled by ($canceledUser)";
                    }
                    else{
                        $action ="<a href='#' class='cancelAppointment' data-href='".url('appointment/cancel/'.$row->code)."'> Cancel <a>";
                    }
                    $each[] = $action;
               // }
                $output ['data'] [] = $each;
	    	}
        }
        


        return response()->json($output);  
    }

   public function cancel(Request $request)
   {
    $fieldName = 'user_id';
    if(auth()->user()->hasRole(config('application.patient_role')))
    {
        $fieldName = 'patient_id';
    }
    
    $query = Appointment::where($fieldName,auth()->id())->where('code',$request->code)
    ->whereRaw('date >= now()')
    ->first();
    if(!isset($query->id)) abort(404);
    if($query->status == Appointment::$STATUS_CANCEL) 
    {
        flash('Appointment Already Canceled')->error()->important();
        return back();
    } 
  
    $query->status = Appointment::$STATUS_CANCEL;
    $query->cancel_by_user = auth()->id();
    
    $query->save();
    if(auth()->user()->hasRole(config('application.patient_role')))
    {
      $this->sendSms($query->patient_contact_number,config('application.cancel_booking_patient_sms_content'));
    }
    $productDetail = ProductItem::where('code',$query->code)->first();
    if(isset($productDetail->id))
    {
        $productDetail->status = 2;
        $productDetail->save();
    }   
    flash('Appointment  Canceled')->success()->important();
    return back();


   }

}