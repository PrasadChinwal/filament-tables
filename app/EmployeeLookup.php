<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLookup extends Model
{
	public $timestamps = false;
	protected $connection = 'oraclecdmpvt';
	protected $table = 'EMP_SUPV_DEPT_UIS';

	protected $fillable = ['uin', 'fname', 'lname', 'posn_title', 'empee_coll_cd', 'empee_coll_name'];

	protected $appends = ['full_name'];

	protected $primaryKey = 'uin';

	public function getFullNameAttribute()
	{
		return $this->attributes['lname'] . ', ' . $this->attributes['fname'];
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'uin', 'uin');
	}

}
