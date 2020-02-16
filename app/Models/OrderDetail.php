<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	protected $table = 'order_details';
	protected $fillable = ['id', 'order_id', 'product_id', 'qty', 'price'];
	public function orders(){
		return $this-> belongsTo('App\Models\Order', 'order_id', 'id');
	}
	public function products(){
		return $this-> belongsTo('App\Models\Product', 'product_id', 'id');
	}
}
