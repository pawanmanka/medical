<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];
    protected $append = ['create_age'];
    public function getPatient(){
        return $this->hasOne(User::class,'id','patient_id');   
    }
    public function getTotalHelpFull(){
        return $this->hasMany(QuestionReview::class,'question_id','id')->where('status',1);   
    }
    public function getTotalNotHelpFull(){
        return $this->hasMany(QuestionReview::class,'question_id','id')->where('status',2);   
    }

    public function getCreateAgeAttribute(){
        $full = false;
        $now = new \DateTime;
        $ago = new \DateTime($this->created_at);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
