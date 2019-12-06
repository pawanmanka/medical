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
    protected $append = ['gender_title','detail_url'];

   

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

// /***
//  * @param $role
//  * @return mixed
//  */
// public function hasRole($role)
// {
//     return in_array($role, $this->getRoles());
// }

// /***
//  * @param $roles
//  * @return mixed
//  */
// public function hasRoles($roles)
// {
//     $currentRoles = $this->getRoles();
//     foreach($roles as $role) {
//         if ( ! in_array($role, $currentRoles )) {
//             return false;
//         }
//     }
//     return true;
// }

// /**
//  * @return array
//  */
// public function getRoles()
// {
//     $roles = $this->belongsToMany(Role::class,'user_roles','user_id','role_id');

//     if (is_null($roles)) {
//         $roles = [];
//     }
//     else{
//         $roles = $roles->get()->pluck('name','name')->toArray(); 
//     }
    

//     return $roles;
// }

// public function roles(){
//     return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
// }


  

}
