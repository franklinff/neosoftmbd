<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocApplicationStatus extends Model
{
    protected $table = 'noc_application_status_log';
    protected $fillable = [
    	'application_id',
        'society_flag',
        'user_id',
        'role_id',
        'status_id',
        'to_user_id',
        'to_role_id',
        'remark'
    ];

    public function getRoleName()
    {
        return $this->hasOne('App\Role', 'id','to_role_id');
    }

    public function getRole()
    {
        return $this->hasOne('App\Role', 'id','role_id');
    }

}
