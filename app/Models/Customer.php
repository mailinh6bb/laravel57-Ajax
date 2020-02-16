<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customers';
	protected $fillable = ['id', 'user_id', 'name', 'address', 'email', 'phone', 'active'];
	public function users(){
		return $this-> belongsTo('App\Models\User', 'user_id', 'id');
	}
}
