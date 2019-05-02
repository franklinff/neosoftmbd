<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'password','mobile_no','address','role_id','uploaded_note_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->withPivot('start_date', 'end_date');
    }

    public function boardUser()
    {
        return $this->hasOne('App\BoardUser', 'user_id', 'id');
    }

    public function LayoutUser()
    {
        return $this->hasOne('App\LayoutUser', 'user_id','id');
    }

    public function Layouts()
    {
        return $this->hasMany('App\LayoutUser', 'user_id','id');
    }
    
    public function department()
    {
        return $this->belongsTo(\App\RtiDepartmentUser::class,'id','user_id');
    }

    public function roleDetails()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }    
}
