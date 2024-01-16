<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'Schedule.dbo.SCHEDULE_TERMS';
}
