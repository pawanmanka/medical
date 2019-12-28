<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];

    public function getPatient(){
        return $this->hasOne(User::class,'id','patient_id');   
    }
}
