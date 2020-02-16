<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';
	protected $fillable = ['id', 'name', 'slug', 'qty', 'description', 'content', 'price','promotinal', 'sale', 'cate_id', 'pro_type_id', 'status', 'avatar'];
	public function product_types(){
		return $this-> belongsTo('App\Models\ProductType', 'pro_type_id', 'id');
	}
	public function categories(){
		return $this-> belongsTo('App\Models\Category', 'cate_id', 'id');
	}
}
