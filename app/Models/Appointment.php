<?php  
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = ["id"];
    protected $appeds = [
        'time',
        'date_str'
    ]; 

    public function getTimeAttribute()
    {
        $date = strtotime($this->date);
        return date('H:s',$date); 
    }
    
    public function getDateStrAttribute()
    {
        $date = strtotime($this->date);
        return date('d-m-Y',$date); 
    }

    public function getPatient()
    {
        return $this->hasOne(User::class,'id','patient_id');
    }
    public function getUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function generateUniqueCode()
    {
        $code = strtoupper(uniqid());
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

