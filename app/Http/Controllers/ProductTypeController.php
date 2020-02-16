<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RequestProductType;
class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $productType = ProductType::paginate(5);
       return view('admin.pages.productType.list',compact('productType'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::select('id', 'name')-> get();
        return view('admin.pages.productType.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestProductType $request)
    {
        $productType = new ProductType();
        $productType -> name = $request -> name;
        $productType -> cate_id = $request -> cate_id;
        $productType -> slug = str_slug($request -> name);
        $productType -> status = $request -> status;
        $productType -> save();
        return redirect()->route('producttype.index')-> with(['thongbao' => 'Thêm Thành Công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producttype = ProductType::find($id);
        $category = Category::select('id', 'name')-> get();
        return Response()-> json(['producttype' => $producttype, 'category' => $category], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        $producttype = ProductType::find($id);
        $producttype -> update([
            'name' => $request -> name,
            'slug' => str_slug($request -> name),
            'cate_id' => $request -> cate_id,
            'status' => $request -> status
        ]);
        return response()-> json(['success'=> 'Sửa Thành Công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producttype = ProductType::find($id);
        if (count($producttype -> products) === 0) {
            $producttype -> delete();
            return response()-> json(['success' => 'Xóa Thành Công'], 200);
        }else{
            return response()-> json(['error' => 'Xóa Không Thành Công'], 200);
        }
    }
}
