<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeLookup extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'uin' => $this->uin,
			'fname' => $this->fname,
			'lname' => $this->lname,
			'netid' => $this->netid,
			];
	}


	public function with($request)
	{
		return [
			'version' => '1.0.0',
			'created_by' => 'UIS ITS',
			];

	}



}
