<?php 

use \Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $table = 'cart_transactions';

	protected $fillable = [
		'reference_id', 
		'transaction_id', 
		'customer_id',
		'payment_id',
		'amount',
		'product_description',
		'remark',
		'status',
		'error',
		];
}