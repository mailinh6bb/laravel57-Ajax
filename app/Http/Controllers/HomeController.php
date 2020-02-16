<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;

use Cart;
use Auth;
class HomeController extends Controller
{
	public function __construct(){
		$category = Category::where('status', 1)-> orderBy('id', 'DESC')->get();
		$productType = ProductType::where('status', 1)->get();
		$productNew = Product::orderBy('id', 'DESC')-> limit(4)->get();
		view()->share(['category' => $category, 'productType' => $productType, 'productNew' => $productNew]);
	}
	public function index(){
		$protypeMen = ProductType::with('products')->where('cate_id', 7)->where('status', 1)->limit(3)-> get();
		$protypeWoman = ProductType::with('products')->where('cate_id', 6)->where('status', 1)->limit(3)-> get();
		$protypeAcces = ProductType::with('products')->where('cate_id', 4)->where('status', 1)->limit(3)-> get();
		$protypeShoes = ProductType::with('products')->where('cate_id', 5)->where('status', 1)->limit(3)-> get();

		$viewData= [
			'protypeMen' => $protypeMen,
			'protypeWoman' => $protypeWoman,
			'protypeAcces' => $protypeAcces,
			'protypeShoes' => $protypeShoes
		];
		return view('client.pages.index', $viewData);
	}
	public function productType(Request $request, $id){
		$productType = ProductType::where('id', $id)->first();
		$product = Product::where('pro_type_id', $id)-> paginate(10);
		if ($request -> price == 1) {
			$product = Product::where('pro_type_id', $id)-> whereBetween('price', [0,200000])->get();
		}
		return view('client.pages.detail_protype', compact(['productType', 'product']));
	}
	public function optionProduct(){

	}
	public function search (Request $request){
		if ($request -> key) {
			$key = $request -> key;
			$products = Product::where('name', 'like','%'.$request -> key.'%')->limit(5)->get();
			$html = view('client.layouts.form_search', compact('products'))->render();
			return response()-> json(['data' => $html] );
		}

	}

}
