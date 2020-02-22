<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $guarded = ['id'];
    protected $append = ['price','status_class'];

    public function getPriceAttribute()
    {
        return auth()->id() != null?$this->discount_price:$this->actual_price;
    }
    public function getStatusClassAttribute()
    {
        $slotArr = config('application.slotArr');
        $title = isset($slotArr[$this->status])?$slotArr[$this->status]:'';
        $title = str_replace(' ','-',$title);
        return $this->status ==1?'':$title;
    }

    public function getProduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }
     
    public function getUser()
    {
       return $this->hasOneThrough(User::class,Product::class,'id','id','product_id','user_id');
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
        return ProductItem::select('code')->where('code', 'like', $code.'%')->get();
    }


}