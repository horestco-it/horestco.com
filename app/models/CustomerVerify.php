<?php
namespace Horestco\My\Model;

use \Illuminate\Database\Eloquent\Model;

class CustomerVerify extends Model
{
	protected $fillable = ['customer_id', 'is_verified', 'hash_key', 'created_at', 'updated_at'];

	public function customer()
	{
		return $this->belongsTo('Horestco\My\Model\Customer');
	}

	public function country()
	{
		return $this->belongsTo('Country');
	}

	public static function insertUnique($data)
	{
		if( !isset($data['email']) || is_null($data['email']) )
		{
			return false;
		}

		if( !self::isExists($data['email']) )
		{
			return self::insertGetId($data);
		}
		return false;
	}

	public static function isExists($email)
	{
		return self::where('email', $email)->exists();
	}
}