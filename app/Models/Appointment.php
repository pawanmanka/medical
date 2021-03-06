<?php  
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public static $STATUS_ACTIVE = 1;
    public static $STATUS_CANCEL = 2;
    public static $PAYMENT_TRANSFER_STATUS_PENDING = 0;
    public static $PAYMENT_TRANSFER_STATUS_DONE = 1;
    protected $guarded = ["id"];
    protected $appeds = [
        'time',
        'date_str',
        'amount'
    ]; 

    public function getTimeAttribute()
    {
        $date = strtotime($this->date);
        return date('H:i',$date); 
    }
    
    public function getAmountAttribute()
    {
        return $this->merchant_amount + $this->admin_margin_amount; 
    }
    
    public function getDateStrAttribute()
    {
        $date = strtotime($this->date);
        return date('d-m-Y',$date); 
    }

    public function getProductItem()
    {
        return $this->hasOne(ProductItem::class,'id','product_item_id');
    }
    public function getPatient()
    {
        return $this->hasOne(User::class,'id','patient_id');
    }
    public function getUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function getAppointmentCancelUser()
    {
        return $this->hasOne(User::class,'id','cancel_by_user');
    }

    public function generateUniqueCode()
    {
        $code = strtoupper(uniqid());
        $code  = substr($code,0,8);
        $allRecord = $this->getRelatedCode($code);
        if (! $allRecord->contains('code', $code)){
            return $code;
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $newOtp = $code.$i;
            if (! $allRecord->contains('code', $newOtp)) {
                return $newOtp;
            }
        }

    }
    protected function getRelatedCode($code)
    {
        return self::select('code')->where('code', 'like', $code.'%')->get();
    }


}

