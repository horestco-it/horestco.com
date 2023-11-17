<?php
namespace Horestco\My\Model;

use \Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $fillable = ['name', 'email', 'country_id'];

	public function contact()
	{
		return $this->hasOne('Horestco\My\Model\CustomerContact');
	}

	public function verify()
	{
		return $this->hasOne('Horestco\My\Model\CustomerVerify');
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