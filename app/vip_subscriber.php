<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vip_subscriber extends Model
{
    protected $table = 'T_ROAMING_VIP_NUMBERS';
    public $primaryKey = 'PROD_NO';
    public $timestamps = false;

}
