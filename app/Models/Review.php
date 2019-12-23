<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];

    public function getPatient(){
        return $this->hasOne(User::class,'id','patient_id');   
    }
}
