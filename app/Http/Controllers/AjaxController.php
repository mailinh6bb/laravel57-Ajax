<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;

class AjaxController extends Controller
{
	public function getProductType($id){
		$productType = ProductType::where('cate_id', $id)->get();
		foreach ($productType as $pt) {
			echo "<option value='".$pt->id."'>".$pt->name."</option>";
		}
	}
}
