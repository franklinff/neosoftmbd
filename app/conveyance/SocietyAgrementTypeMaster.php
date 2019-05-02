<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class SocietyAgrementTypeMaster extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'society_agrement_type_master';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agreement_name',
    ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
