<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutStatusLog extends Model
{
    protected $table="architect_layout_status_logs";

    public function getRoleName()
    {
        return $this->hasOne('App\Role', 'id','to_role_id');
    }

    public function getCurrentRole()
    {
        return $this->hasOne('App\Role', 'id','role_id');
    }

    public function architect_layout()
    {
        return $this->belongsTo('App\Layout\ArchitectLayout','architect_layout_id','id');
    }
}
