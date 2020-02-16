@extends('admin.layout.master')
@section('title', 'Trang Chủ')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Sản Phẩm <a href="{{ route('product.create')}}" style="float:right;" title="">Thêm Mới</a></h6>

  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Sản Phẩm</th>
            <th>Hình Ảnh</th>
            <th>Danh Mục</th>
            <th>Loai Sản Phẩm</th>
            <th>Trang Thái</th>
            <th>Chỉnh sửa</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($product))
          @foreach ($product as $key => $pro_item)
          <tr>
            <td>{{$key+1}}</td>
            <td>
              <ul style="list-style: none;">
                <li>Tên: {{$pro_item -> name}}</li>
                <br>
                <li>Giá: {{number_format($pro_item -> price, 0, ',', '.')}} VND</li>
                <br>
                <li>Giảm: {{$pro_item -> sale}}%</li>
              </ul>
            </td>
            <td><img src="{{ asset('upload/image_product/file/'.$pro_item -> avatar) }}" style="height: 130px; width: 110px;" alt="{{$pro_item -> slug}}"></td>
            <td>{{$pro_item -> categories -> name}}</td>
            <td>{{$pro_item -> product_types -> name}}</td>
            <td>{{$pro_item -> status}}</td>
            <td>
              <button class="btn btn-primary edit" data-id="{{$pro_item -> id}}" data-toggle="modal" data-target="#edit" type="button"><i class="fas fa-edit"></i></button>
              <button class="btn btn-danger delete" data-id="{{$pro_item -> id}}" data-toggle="modal" data-target="#delete" type="button"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Edit Modal-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa - <i class="title"></i></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" style="margin: 5px">
          <div class="col-lg-12">
            <form id="productUpdate" method="POST" enctype="multipart/form-data" role="form">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Tên Sản Phẩm</label>
                  <br>
                  <span class="text-danger errorsName">
                  </span>
                  <input type="text" class="form-control name" name="name" placeholder="Nhập tên sản phẩm" value="">
                </div>
                <div class="form-group">
                  <label>Danh Mục</label>
                  <select class="form-control" id="cate_id" name="cate_id">
                  </select>
                </div>
                <div class="form-group">
                  <label>Loại Sản Phẩm</label>
                  <select class="form-control" id="pro_type_id" name="pro_type_id">
                  </select>
                </div>
                <div class="form-group">
                  <label for="avatar">Hình Ảnh</label>
                  <span class="text-danger errorsAvatar">
                  </span>
                  <img class="avatar" src="" style="width: 100px; height: 120px;" alt="">
                  <input class="form-control" type="file" name="avatar" value="" placeholder="">
                </div>
                <div class="form-group">
                  <label for="">Giá</label>
                  <span class="text-danger errorsPrice">
                  </span>
                  <input class="form-control price" type="number" name="price" value="" placeholder="">
                </div>
                <div class="form-group">
                  <label for="">Số Lượng</label>
                  <span class="text-danger errorsQty">
                  </span>
                  <input class="form-control qty" type="number" name="qty" value="" placeholder="">
                </div>
                <div class="form-group">
                  <label for="">Giảm</label>
                  <input class="form-control sale" type="number" name="sale" value="" placeholder="">
                </div>
                <div class="form-group">
                  <label>Mô Tả</label>
                  <br>
                  <span class="text-danger errorsDescription">
                  </span>
                  <textarea class="form-control description" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label>Nội Dung</label>
                  <br>
                  <span class="text-danger errorsContent">
                  </span>
                  <textarea id="editor" class="form-control content" name="content"></textarea>
                </div>
                <div class="form-group">
                  <input type="radio" name="status" checked="" value="1"> Hiển Thị    
                  <input type="radio" name="status" value="0"> Không Hiển Thị       
                </div>
              </div>
              <input type="submit" class="btn btn-success" value="Save"></input>
              <button type="reset" class="btn btn-primary">Làm Lại</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" style="margin-left: 183px;">
        <button type="button" class="btn btn-success del">Có</button>
        <button class="btn btn-secondary deleteNo" type="button" data-dismiss="modal">Không</button>
        <div>
        </div>
      </div>
    </div>
    @stop
    @section('script')
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $(document).ready(function(){
        $('.edit').click(function(){
          $('.errorsName').hide();
          $('.errorsPrice').hide();
          $('.errorsDescription').hide();
          $('.errorsContent').hide();
          $('.errorsQty').hide();
          $('.errorsAvatar').hide();          
          let id = $(this).data('id');
                   //Edit
                   $.ajax({
                    url: '/admin/product/'+id+'/edit',
                    dataType: 'json',
                    type:'get',
                    success:function($result){
                      $('.name').val($result.product.name);
                      $('.price').val($result.product.price);
                      $('.qty').val($result.product.qty);
                      $('.sale').val($result.product.sale);
                      $('.avatar').attr('src','/upload/image_product/file/'+$result.product.avatar);                      
                      $('.description').val($result.product.description);
                      CKEDITOR.instances['editor'].setData($result.product.content);
                      $('.title').text($result.product.name);

                      var html ='';
                      $.each($result.category, function($key, $value){
                        if ($value['id'] == $result.product.cate_id) {
                          html += '<option value='+$value['id']+' selected>';
                          html += $value['name'];
                          html += '</option>';
                        }
                        else {
                          html += '<option value='+$value['id']+'>';
                          html += $value['name'];
                          html += '</option>';
                        }
                        $('#cate_id').html(html);
                      });
                      $.each($result.productType, function($key, $value){
                        if ($value['id'] == $result.product.pro_type_id) {
                          html += '<option value='+$value['id']+' selected>';
                          html += $value['name'];
                          html += '</option>';
                        }
                        else {
                          html += '<option value='+$value['id']+'>';
                          html += $value['name'];
                          html += '</option>';
                        }
                        $('#pro_type_id').html(html);
                      });

                      if ($result.product.status == 1) {
                        $('.ht').attr('checked', 'checked');
                      }
                      else{
                        $('.kht').attr('checked', 'checked');
                      }
                    }
                  });

                   $('#productUpdate').on('submit',function(event){
                    // chặn from submit
                    event.preventDefault();
                    // let name = $('.name').val();
                    // let status = $('input[name=status]:checked').val();
                    // let cate_id = $('#cate_id').val();
                    $.ajax({
                      url: '/admin/product-update/'+id,
                      data:new FormData(this),
                      contentType: false, // chặn kiểu dữ liệu trả về mặc
                      processData: false, // chặn tiến trình gởi dữ liệu
                      cache: false,
                      type:'post',
                      success:function($result){
                        if ($result.error == 'true') {
                          if ($result.message.name) {
                           $('.errorsName').show();
                           $('.errorsName').html($result.message.name[0]);    
                         } 
                         if ($result.message.price) {
                           $('.errorsPrice').show();
                           $('.errorsPrice').html($result.message.price[0]);    
                         }  
                         if ($result.message.qty) {
                           $('.errorsQty').show();
                           $('.errorsQty').html($result.message.qty[0]);    
                         } 
                         if ($result.message.description) {
                           $('.errorsDescription').show();
                           $('.errorsDescription').html($result.message.description[0]);    
                         }
                         if ($result.message.content) {
                           $('.errorsContent').show();
                           $('.errorsContent').html($result.message.content[0]);    
                         }
                         if ($result.message.avatar) {
                           $('.errorsAvatar').show();
                           $('.errorsAvatar').html($result.message.avatar[0]);    
                         } 
                       }
                       else {
                        toastr.success($result.success, 'Thông Báo',{timeOut: 10000});
                        $('#edit').modal('hide');
                        location.reload();
                      }

                    }
                  });
                  });
                 });
$('.delete').click(function(){
  let id = $(this).data('id');
  $('.del').click(function(){
    $.ajax({
      url: '/admin/product/'+id,
      data:{
        name: name,
        status: status
      },
      dataType: 'json',
      type:'delete',
      success:function($result){
        toastr.success($result.success, 'Thông Báo',{timeOut: 10000});
        location.reload();
      }
    });
  })
});
$('.deleteNo').click(function(){
  location.reload();
})
$('.close').click(function(){
 location.reload();
})
});
</script>
@stop