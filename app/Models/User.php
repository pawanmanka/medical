<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $append = ['gender_title','detail_url','role_name'];

   

    public function getRoleNameAttribute(){
        $role = $this->roles()->first();
        return $role->name;
    }
    public function getGenderTitleAttribute(){
        $genderArr = config('application.genderArr');
        return isset($genderArr[$this->gender])?$genderArr[$this->gender]:'';
    }
    public function getDetailUrlAttribute(){
        return url('detail/'.$this->slug);
    }

    public function getUserInformation(){
        return $this->hasOne(UserInformation::class,'user_id');
    }

    public function getUserRating(){
        return $this->hasMany(Review::class,'user_id','id');
    }
    public function getQuestions(){
        return $this->hasMany(Question::class,'user_id','id');
    }

    public function getUserCertificate(){
        return $this->hasMany(UserCertificate::class,'user_id');
    }
   
    public function getProducts(){
        return $this->hasMany(Product::class,'user_id');
    }
    public function getWallet(){
        return $this->hasOne(Wallet::class,'user_id');
    }
}
