@extends('admin.layout.master')
@section('title', 'Trang Chủ')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh Mục <a href="{{ route('admin.get.add.category')}}" style="float:right;" title="">Thêm Mới</a></h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Danh Mục</th>
                        <th>Slug</th>
                        <th>Trang Thái</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($category))
                    @foreach ($category as $key => $cate_item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$cate_item -> name}}</td>
                        <td>{{$cate_item -> slug}}</td>
                        <td>{{$cate_item -> status}}</td>
                        <td>
                            <button class="btn btn-primary edit" data-id="{{$cate_item -> id}}" data-toggle="modal" data-target="#edit" type="button"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger delete" data-id="{{$cate_item -> id}}" data-toggle="modal" data-target="#delete" type="button"><i class="fas fa-trash-alt"></i></button>
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
                      <form role="form">
                        <div class="col-md-6">

                            <fieldset class="form-group">
                                <label>Tên Danh Mục</label>
                                <br>

                                <span class="text-danger errors">

                                </span>

                                <input class="form-control name" name="name" value="" placeholder="nhập tên danh mục">
                            </fieldset>
                            
                        </div>
                        <div class="form-group">
                           <input type="radio" class="ht" name="status" checked="" value="1"> Hiển Thị    
                           <input type="radio" class="kht" name="status" value="0"> Không Hiển Thị         
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
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
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
                    url: '/admin/category/edit/'+id,
                    dataType: 'json',
                    type:'get',
                    success:function($result){
                        $('.name').val($result.name);
                        $('.title').text($result.name);
                        if ($result.status == 1) {
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
                    $.ajax({
                        url: '/admin/category/edit/'+id,
                        data:{
                            id: id,
                            name: name,
                            status: status
                        },
                        dataType: 'json',
                        type:'post',
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
                            url: '/admin/category/delete/'+id,
                            data:{
                                id: id,
                                name: name,
                                status: status
                            },
                            dataType: 'json',
                            type:'get',
                            success:function($result){
                                if ($result.success) {
                                   toastr.success($result.success, 'Thông Báo',{timeOut: 5000});
                                   location.reload();
                               }else {
                                toastr.error($result.error, 'Thông Báo',{timeOut: 5000});
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
