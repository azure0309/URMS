<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alarm extends Model
{
    protected $table = 'RM_ALARM_BILL';
    public $primaryKey = 'id';
    public $timestamps = false;
}
