<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inbound_tap extends Model
{
    protected $table = 'ABA_RM_INB_USAGE';
    // public $primaryKey = 'id';
    public $timestamps = false;
}
