<?php
namespace Horestco\My\Model;

use \Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
	protected $fillable = ['address', 'customer_id', 'country_id', 'city', 'zip', 'telephone'];

	public $timestamps = false;

	public function customer()
	{
		return $this->belongsTo('Horestco\My\Model\Customer');
	}
}