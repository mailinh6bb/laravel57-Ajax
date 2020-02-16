<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Auth;
use App\Models\User;
class CategoryController extends Controller
{
	public function list(){
		$user = Auth::user();
		if ($user -> can('view', Category::class)) {
			$category = Category::paginate(10);
			return view('admin.pages.category.list', compact('category'));
		}
		return redirect()-> route('admin.home')-> with(['error' => 'Bạn Không Có Quyền Vô Trang Này! Cảm Ơn']);

	}
	public function add(){
		$user = Auth::user();
		if ($user -> can('create', Category::class)) {
			return view('admin.pages.category.add');
		}
		return redirect()-> back()-> with(['error' => 'Bạn Không Có Quyền Vô Trang Này! Cảm Ơn']);

	}
	public function save(RequestCategory $requestCategory){
		$category = new Category();
		$category -> name = $requestCategory -> name;
		$category -> slug = str_slug($requestCategory -> name);
		$category -> status = $requestCategory -> status;
		$category -> save();
		return redirect()->route('admin.get.list.category')->with('thongbao', 'Thêm Thành Công');
	}
	public function edit(Request $request, $id){
		$category = Category::find($id);
		return Response()-> json($category, 200);
	}
	public function update(Request $request, $id){
		$errors =validator::make($request -> all(), [
			'name' => 'required|min:6|max:20',
		], [
			'name.required' => 'Bạn chưa nhập tên',
			'name.min' => 'Tên phải từ 6-20 ký tự',
			'name.max' => 'Tên phải từ 6-20 ký tự',
		]);
		if ($errors -> fails()) {
			return response()-> json(['errors' => 'true', 'message'=> $errors ->errors()], 200);
		}
		$category = Category::find($id);
		$category -> update([
			'name' => $request -> name,
			'slug' => str_slug($request -> name),
			'status' => $request -> status
		]);
		return response()-> json(['success'=> 'Sửa Thành Công']);
	}
	public function delete($id){
		$category = Category::find($id);
		if (count($category -> product_types) === 0) {
			$category -> delete();
			return response()-> json(['success' => 'Xóa Thành Công']);
		}else{
			return response()-> json(['error' => 'Xóa Không Thành Công']);

		}	
		
	}
}
