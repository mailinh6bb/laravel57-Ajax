@extends('admin.layout.master')
@section('title', 'Trang Chủ')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Loại Sản Phẩm <a href="{{ route('producttype.create')}}" style="float:right;" title="">Thêm Mới</a></h6>

  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên Loại Sản Phẩm</th>
            <th>Tên Không Dấu</th>
            <th>Danh Mục</th>
            <th>Trang Thái</th>
            <th>Chỉnh sửa</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($productType))
          @foreach ($productType as $key => $pro_type)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$pro_type -> name}}</td>
            <td>{{$pro_type -> slug}}</td>
            <td>{{$pro_type -> categories -> name}}</td>
            <td>{{$pro_type -> status}}</td>
            <td>
              <button class="btn btn-primary edit" data-id="{{$pro_type -> id}}" data-toggle="modal" data-target="#edit" type="button"><i class="fas fa-edit"></i></button>
              <button class="btn btn-danger delete" data-id="{{$pro_type -> id}}" data-toggle="modal" data-target="#delete" type="button"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
      {{ $productType -> links()}}
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
            <form role="form">
              <div class="col-md-8">

                <fieldset class="form-group">
                  <label>Tên Danh Mục</label>
                  <br>
                  <span class="text-danger errors">
                  </span>

                  <input class="form-control name" name="name" value="" placeholder="nhập tên danh mục">
                </fieldset>
                <div class="form-group">
                 <select class="form-control" id="cate_id" name="cate_id">
                 </select>
               </div>
               <div class="form-group">
                 <input type="radio" class="ht" name="status" value="1"> Hiển Thị    
                 <input type="radio" class="kht" name="status" value="0"> Không Hiển Thị         
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-success update">Save</button>
      <button type="reset" class="btn btn-primary">Làm Lại</button>
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
          $('.errors').hide();
          let id = $(this).data('id');
                   //Edit
                   $.ajax({
                    url: '/admin/producttype/'+id+'/edit',
                    dataType: 'json',
                    type:'get',
                    success:function($result){
                      $('.name').val($result.producttype.name);
                      $('.title').text($result.producttype.name);
                      
                      var html ='';
                      $.each($result.category, function($key, $value){
                        if ($value['id'] == $result.producttype.cate_id) {
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

                      if ($result.producttype.status == 1) {
                        $('.ht').attr('checked', 'checked');
                      }
                      else{
                        $('.kht').attr('checked', 'checked');
                      }
                    }
                  });

                   $('.update').click(function(){
                    let name = $('.name').val();
                    let status = $('input[name=status]:checked').val();
                    let cate_id = $('#cate_id').val();
                    $.ajax({
                      url: '/admin/producttype/'+id,
                      data:{
                        id: id,
                        name: name,
                        status: status,
                        cate_id: cate_id
                      },
                      dataType: 'json',
                      type:'put',
                      success:function($result){
                        if ($result.errors == 'true') {
                         $('.errors').show();
                         $('.errors').html($result.message.name[0]);    
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
              url: '/admin/producttype/'+id,
              data:{
                id: id,
                name: name,
                status: status
              },
              dataType: 'json',
              type:'delete',
              success:function($result){
               if ($result.success) {
                 toastr.success($result.success, 'Thông Báo',{timeOut: 10000});
                 location.reload();
               }else {
                toastr.error($result.error, 'Thông Báo',{timeOut: 10000});
                location.reload();
              }

            }
          });
          })
          $('.deleteNo').click(function(){
            location.reload();
          })
          $('.close').click(function(){
           location.reload();
         })
        });
      });
    </script>
    @stop