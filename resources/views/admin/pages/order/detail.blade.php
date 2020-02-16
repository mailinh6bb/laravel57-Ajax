@extends('admin.layout.master')
@section('title', 'Trang Chủ')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Chi Tiết Đơn Hàng</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên Sản Phẩm</th>
            <th>Hình Ảnh</th>
            <th>Số Lượng</th>    
            <th>Tùy Chọn</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($orderDetails))
          @foreach ($orderDetails as $key => $orderDetail)
          <tr>
            <td>{{$key+1}}</td>
            <td>
              <ul style="list-style: none;">
                <li>Tên: {{$orderDetail -> products -> name}}</li>
                <br>
                <li>Giá: {{number_format($orderDetail -> price, 0, ',', '.')}} VND</li>
                <br>
              </ul>
            </td>
            <td>
              <img src="{{ asset('/upload/image_product/file/'.$orderDetail -> products -> avatar) }}" style="height: 100px; width: 80px;" alt="">
            </td>
            <td>{{$orderDetail -> qty}}</td>
            <td>
              <button class="btn btn-danger delete" data-id="{{$orderDetail -> id}}" data-toggle="modal" data-target="#delete" type="button"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
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
      </div>
    </div>
  </div>
</div>
@stop