<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTrans extends Model
{
    public $table ='wallet_trans';
    protected $guarded = ['id'];
    public function wallet()
    {
        return $this->hasOne(Wallet::class,'id','wallet_id');
    }
}

