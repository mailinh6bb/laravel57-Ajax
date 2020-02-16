   @extends('admin.layout.master')
   @section('title', 'Category')
   @section('content')
   <div class="card shadow mb-4">
   	<div class="card shadow mb-4">
   		<div class="card-header py-3">
   			<h6 class="m-0 font-weight-bold text-primary">Thêm Mới Sản Phẩm</h6>
   		</div>
   		<div class="row" style="margin: 5px">
   			<div class="col-lg-12">
   				<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" role="form">
   					@csrf
   					<div class="col-6">
   						<div class="form-group">
                        <label>Tên Sản Phẩm</label>
                        <br>
                        @if ($errors->has('name'))
                        <span class="text-danger">
                           {{ $errors->first('name') }}
                        </span>
                        @endif
                        <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="">
                     </div>
                     <div class="form-group">
                        <label>Danh Mục</label>
                        <select class="form-control" id="cate_id" name="cate_id">
                           @if (isset($category))
                           @foreach ($category as $cate_id)
                           <option value="{{$cate_id -> id}}">{{$cate_id -> name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Loại Sản Phẩm</label>
                        <select class="form-control" id="pro_type_id" name="pro_type_id">
                           @if (isset($productType))
                           @foreach ($productType as $cate_id)
                           <option value="{{$cate_id -> id}}">{{$cate_id -> name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="avatar">Hình Ảnh</label>

                        <input class="form-control" type="file" name="avatar" value="" placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="">Giá</label>
                        @if ($errors->has('price'))
                        <span class="text-danger">
                           {{ $errors->first('price') }}
                        </span>
                        @endif
                        <input class="form-control" type="number" name="price" value="" placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="">Số Lượng</label>
                        @if ($errors->has('qty'))
                        <span class="text-danger">
                           {{ $errors->first('qty') }}
                        </span>
                        @endif
                        <input class="form-control" type="number" name="qty" value="" placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="">Giảm</label>
                        <input class="form-control" type="number" name="sale" value="" placeholder="">
                     </div>
                     <div class="form-group">
                        <label>Mô Tả</label>
                        <br>
                        @if ($errors->has('description'))
                        <span class="text-danger">
                           {{ $errors->first('description') }}
                        </span>
                        @endif
                        <textarea class="form-control" name="description"></textarea>
                     </div>
                     <div class="form-group">
                        <label>Nội Dung</label>
                        <br>
                        @if ($errors->has('content'))
                        <span class="text-danger">
                           {{ $errors->first('content') }}
                        </span>
                        @endif
                        <textarea id="editor" class="form-control ckeditor" name="content"></textarea>
                     </div>
                     <div class="form-group">
                        <input type="radio" name="status" checked="" value="1"> Hiển Thị    
                        <input type="radio" name="status" value="0"> Không Hiển Thị       
                     </div>
                     <button type="submit" class="btn btn-success">Thêm Mới</button>
                     <button type="reset" class="btn btn-primary">Reset</button>
                  </div>
               </form>
            </div>
         </div>
      </div> 
   </div>
   @stop
   @section('script')
   <script>
      $('#cate_id').change(function(){
         let cate_id = $(this).val();
         $.get("/admin/ajax/product/"+cate_id, function(data){
            $("#pro_type_id").html(data);
         });
         // ngoài ra t còn có thể trả về json rùi each();
      });
   </script>
   @stop