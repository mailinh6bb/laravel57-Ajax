<?php

namespace App\Http\Controllers;
use Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Mail;
use App\Mail\ShoppingMail;

class CartController extends HomeController
{
	public function index(){
		$cart = Cart::content();
		return view('client.pages.cart', compact('cart'));
	}
	// lưu thông tin đơn hàng
	public function store(Request $request){
		if ($request -> ajax()) {
			$data = $request->all();
			$data['user_id'] = Auth::user()->id;
			$data['code_order'] = 'order'.rand();
			$data['status'] = 0;
			$order = Order::create($data);
			$idOrder = $order->id;
			$orderdetail = [];
			$orderdetails = []; 
			foreach( Cart::content() as $key => $cart ){
				$orderdetail['order_id'] = $idOrder;
				$orderdetail['product_id'] = $cart->id;
				$orderdetail['qty'] = $cart->qty;
				$orderdetail['price'] = $cart->price;
				$orderdetails[$key] = OrderDetail::create($orderdetail);
			}
			Mail::to($order->email)->send(new ShoppingMail($order,$orderdetails));
			Cart::destroy();
			return response() -> json(['result' => 'Bạn đã thanh toán thành công']);
			
		}
	}
// thêm sản phẩm vào giỏ hàng
	public function add($id){
		$productCart = Product::find($id);
		if ($productCart -> sale > 0) {
			$price = $productCart -> price*(100-$productCart-> sale)/100;
		}
		else {
			$price = $productCart -> price;
		}
		if ($productCart -> qty > 0) {
			Cart::add(['id' => $productCart -> id, 'name' => $productCart -> name, 'qty' => 1, 'price' => $price,
				'options' => [
					'avatar' => $productCart -> avatar,
					'sale' => $productCart -> sale,
				]
			]);
			return back() -> with(['thongbao' => 'Thêm Giỏ Hàng Thành Công']);
		}
		return back() -> with(['error' => 'Sản Phẩm Tạm Hết Hàng']);
	}

	// update số lượng sản phẩm trong giỏ hàng
	public function update(Request $request, $id){
		if ($request -> ajax()) {
			$number = Product::find($request -> proid);
			// kiểm tra số lượng sản phẩm
			if ($number -> qty > 0) {
				Cart::update($id, $request -> qty);
				return response()-> json(['result' => 'Đã Sửa Thành Công '.$number -> name]);
			}
			return response()-> json(['error' => 'Sửa không thành công. Tạm hết hàng']);
			
		}
		return response()-> json(['error' => 'Sửa không thành công']);
	}
	public function destroy($id){
		Cart::remove($id);
		return response()-> json(['result' => 'Đã xóa Thành Công ']);
	}
	public function checkout(){
		$user = User::find(Auth::id());
		$price = str_replace(',','', Cart::subTotal());
		$cart = Cart::content();
		return view('client.pages.checkout', compact(['user', 'price', 'cart']));
	}

}
