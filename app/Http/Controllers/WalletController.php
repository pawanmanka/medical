<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletTrans;
use App\Traits\DatatableGrid;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    use DatatableGrid;
    public function __construct()
    {
        $this->data = array();
    }  

    public function index(){
        $this->data['title'] = 'Wallet';
        $walletObj = Wallet::where([
            'user_id'=>auth()->id()
        ])->first();
        $this->data['amount'] = isset($walletObj->amount)?$walletObj->amount:0;
        return view('my-wallet',$this->data);
    } 
    
    public function grid(Request $request){
        $fields = array(
            "id",
            "create_at",
            "amount"
          );
    	$this->columns =$fields;
        $this->searchColumns =$fields;
    	$this->setOrderBy();  	
    	$this->setSearchCondition();
    	
        $this->query = WalletTrans::whereHas('wallet',function($query){
             $query->where('user_id',auth()->id());
        });        
    	$output = $this->getGridData();
        if(!empty($output['recordsTotal']) && $output['recordsTotal']>0 && !empty($output['data'])){
        	$result = $output['data'];
            $output ['data'] = array();
            
            foreach ($result as $row){
                $editLink = url("create-slots/$row->id");
                
                $output ['data'] [] = array (
	    			$row->id,
	    			$row->description,
	    			$row->created_at->format('d-m-Y h:i'),
	    			$row->amount,
	    		
	    		);
	    	}
        }
        return response()->json($output);  
    } 

    public function addPayment(Request $request){
        $rules = array(
            'money'=>'required'
        );

        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
            flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            
        }        
    }

    public function paySuccess(Request $request){
        $rules = array(
            'payPaymentId'=>'required',
            'totalAmount'=>'required',
            'productId'=>'required'
        );
        $total = 0;
        $status = self::$ERROR;
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
            $message =   makeErrorMessage($validation->errors()->messages());
        }
        else{
            $status = self::$SUCCESS;
            $walletObj = Wallet::firstOrCreate([
                'user_id'=>auth()->id()
            ]);
           $walletObj->amount = !empty($walletObj->amount)?$walletObj->amount:0;
           $walletTransObj = new WalletTrans();
           $walletTransObj->user_id = auth()->id();
           $walletTransObj->action_user_id = auth()->id();
           $walletTransObj->wallet_id = $walletObj->id; 
           $walletTransObj->before_total = $walletObj->amount; 
           $walletTransObj->amount = $request->totalAmount;
           $walletTransObj->after_total = $walletObj->amount + $request->totalAmount;
           $walletTransObj->description = " add money $request->totalAmount";
           $walletTransObj->payment_id = $request->payPaymentId;
           $walletTransObj->save();
 
           $walletObj->amount = $walletTransObj->after_total;
           $walletObj->save();
           $total = $walletObj->amount;

           $message = 'Money Add Successfully';
        }

        $result = array(
            'status'=>$status,
            'message'=>$message,
            'total'=>$total,
        );

        return response()->json($result);
    }

    public function addMoney(Request $request)
    {
        $rules = array(
            'money'=>'required'
        );

        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
            flash(makeErrorMessage($validation->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
           $walletObj = Wallet::firstOrCreate([
               'user_id'=>auth()->id()
           ]);
          $walletObj->amount = !empty($walletObj->amount)?$walletObj->amount:0;
          $walletTransObj = new WalletTrans();
          $walletTransObj->user_id = auth()->id();
          $walletTransObj->action_user_id = auth()->id();
          $walletTransObj->wallet_id = $walletObj->id; 
          $walletTransObj->before_total = $walletObj->amount; 
          $walletTransObj->amount = $request->money;
          $walletTransObj->after_total = $walletObj->amount + $request->money;
          $walletTransObj->description = " add money $request->money";
          $walletTransObj->save();

          $walletObj->amount = $walletTransObj->after_total;
          $walletObj->save();
          flash('Money Add Successfully')->success()->important();
          return back()->withInput(); 
        }
    }

}
