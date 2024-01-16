<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VScheduleReport extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'Schedule.dbo.V_SCHEDULEREPORT';
}
