<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
	protected $table = 'product_types';
	protected $fillable = ['id', 'cate_id', 'slug', 'name', 'status']; 
	public function categories(){
		return $this-> belongsTo('App\Models\Category', 'cate_id', 'id');
	}
	public function products(){
		return $this-> hasMany('App\Models\Product', 'pro_type_id', 'id');
	}
}
