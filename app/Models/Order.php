<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
	protected $fillable = ['id', 'code_order', 'user_id', 'name', 'address', 'email', 'phone', 'money', 'note', 'status'];
	public function users(){
		return $this-> belongsTo('App\Models\User', 'user_id', 'id');
	}
}
