<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterTenantType extends Model
{
    protected $table = 'master_tenant_type';
 	
 	public function ArrearsChargesRate() {
 		return $this->belongsTo(ArrearsChargesRate::class);
 	}   
}
