<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiStatus extends Model
{
	public $table = "rti_status";

    protected $fillable = [
    	'status_id',
    	'application_id'
    ];

    public function status_title()
    {
    	return $this->belongsTo(MasterRtiStatus::class,'status_id','id');
    }
}
