<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $guarded = ['id'];

    public function getProduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }

}