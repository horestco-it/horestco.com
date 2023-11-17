<?php

use \Illuminate\Database\Eloquent\Model;

class PortoCategory extends Model
{
	public function clients()
	{
		return $this->hasMany('PortoClient');
	}
}