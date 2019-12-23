<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static $DOCTOR = 1;
    public static $HOSPITAL = 2;
    public static $LAB = 3;

    protected $guarded = ['id'];
    protected $append = ['dateFormated'];

    public function getDateFormatedAttribute(){
           return   date('d-m-Y',strtotime($this->date));
    }

    public function productItems()
    {
       return $this->hasMany(ProductItem::class,'product_id','id');
    }

}