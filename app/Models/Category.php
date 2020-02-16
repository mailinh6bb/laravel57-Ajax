<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
	protected $fillable = ['id', 'slug', 'name', 'status'];
	public function product_types(){
		return $this-> hasMany('App\Models\ProductType','cate_id', 'id');
	}
}
