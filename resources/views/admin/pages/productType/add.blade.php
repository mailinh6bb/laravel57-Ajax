   @extends('admin.layout.master')
   @section('title', 'Category')
   @section('content')
   <div class="card shadow mb-4">
   	<div class="card shadow mb-4">
   		<div class="card-header py-3">
   			<h6 class="m-0 font-weight-bold text-primary">Loại Sản Phẩm</h6>
   		</div>
   		<div class="row" style="margin: 5px">
   			<div class="col-lg-12">
   				<form action="{{ route('producttype.store') }}" method="POST" role="form">
   					@csrf
   					<div class="col-md-8">
   						
   						<fieldset class="form-group">
   							<label>Tên Loại Sản Phẩm</label>
   							<br>
   							@if ($errors->has('name'))
   							<span class="text-danger">
   								{{ $errors->first('name') }}
   							</span>
   							@endif
                        <input class="form-control" name="name" placeholder="nhập tên danh mục">
                     </fieldset>
                     <div class="form-group">
                       <select class="form-control" name="cate_id">
                        @if (isset($category))
                        @foreach ($category as $cate_id)
                        <option value="{{$cate_id -> id}}">{{$cate_id -> name}}</option>
                        @endforeach
                        @endif

                     </select>
                  </div>
                  <div class="form-group">
                     <input type="radio" name="status" checked="" value="1"> Hiển Thị    
                     <input type="radio" name="status" value="0"> Không Hiển Thị			
                  </div>
               </div>
               <button type="submit" class="btn btn-success">Thêm Mới</button>
               <button type="reset" class="btn btn-primary">Reset</button>
            </form>
         </div>
      </div>
   </div> 
</div>
@stop