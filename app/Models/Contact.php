<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';
	protected $fillable = ['id', 'user_id', 'name', 'note'];
	public function users(){
		return $this-> belongsTo('App\Models\User', 'user_id', 'id');
	}
}
