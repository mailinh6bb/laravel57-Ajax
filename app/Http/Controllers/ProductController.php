<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::where('status', 1) -> paginate(10);
        return view('admin.pages.product.list', compact('product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)-> get();
        $productType = ProductType::where('status', 1)-> get();
        return view('admin.pages.product.add', compact(['category','productType']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestProduct $request)
    {
       if ($request -> hasFile('avatar')) {
        $file = $request -> avatar;
        //lấy tên
        $file_name = $file -> getClientOriginalName();
        //lấy loại file
        $file_type = $file ->getMimeType();
        // lấy kích thước file
        $file_size = $file ->getSize();
        if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' ) {
            $file_name = date('d-m-yy').'_'.rand().'_'.$file_name;
            if ($file_size <= 1048576) {
                $data = $request -> all();
                $data['slug'] = str_slug($request -> name);
                $data['avatar'] = $file_name;
                Product::create($data);
                $file -> move('upload/image_product/file/',$file_name);
                return redirect()->route('product.index')->with('thongbao', 'Bạn đã thêm thành công');

            } else {
                return back()->with('error','Kích Thước file quá lớn.');
            }

        }
        else{
            return back()->with('error','Loại file không cho phép.');
        }
    }
    else{

        return back()->with('error','Bạn chưa chọn hình ảnh.');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $category = Category::where('status', 1)->get();
        $productType = ProductType::where('status', 1)->get();
        $product = Product::find($id);
        return response() -> json(['category' => $category, 'productType' => $productType, 'product' => $product], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $errors =validator::make($request -> all(), [
            'name' => 'required|min:6|max:100',
            'price' => 'required',
            'qty' => 'required',
            'description' => 'required|max:300',
            'content' => 'required',
            'avatar' => 'image'
        ], [
            'name.required' => 'Bạn chưa nhập tên sản phẩm.',
            'name.min' => 'Tên phải có đọ dài từ 6-100 ký tự.',
            'name.max' => 'Tên phải có đọ dài từ 6-100 ký tự.',
            'price.required' => 'Bạn chưa nhập giá.',
            'qty.required' => 'Bạn chưa nhập số lượng.',
            'description.required' => 'Bạn chưa nhập mô tả.',
            'content.required' => 'Bạn chưa nhập nội dung.',
            'avatar.image' => 'Hình của bạn không hợp lệ.'
        ]);
        if ($errors ->fails()) {
            return response()->json(['error' => 'true', 'message' => $errors -> errors()], 200);
        }
        $product = Product::find($id);
        $data['slug'] = str_slug($request -> name);
        $data = $request -> all();
        if ($request -> hasFile('avatar')) {
            $file = $request -> avatar;
        //lấy tên
            $file_name = $file -> getClientOriginalName();
        //lấy loại file
            $file_type = $file ->getMimeType();
        // lấy kích thước file
            $file_size = $file ->getSize();
            if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' ) {
                $file_name = date('d-m-yy').'_'.rand().'_'.$file_name;
                if ($file_size <= 1048576) {
                    $data['avatar'] = $file_name;
                    $file -> move('upload/image_product/file/',$file_name);
                    if (File::exists('upload/image_product/file/'.$product -> avatar)) {
                        // xóa ảnh cũ
                     unlink('upload/image_product/file/'.$product -> avatar);
                 }

             } else {
                return back()->with('error','Kích Thước file quá lớn.');
            }

        }
        else{
            return back()->with('error','Loại file không cho phép.');
        }
    }else{
        $data['avatar'] = $product -> avatar;
    }
    $product-> update($data);
    return response()-> json(['success' =>  'Bạn đã sửa thành công.']);

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        // kiểm tra và xóa ảnh trong thư mục
        if (File::exists('upload/image_product/file/'.$product -> avatar)) {
            unlink('upload/image_product/file/'.$product -> avatar);
        }
        $product -> delete();
        return response()-> json(['success' =>  'Bạn đã xóa thành công.']);
    }
}
