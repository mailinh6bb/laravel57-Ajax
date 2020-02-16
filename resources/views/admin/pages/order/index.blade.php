@extends('admin.layout.master')
@section('title', 'Trang Chủ')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Đơn Hàng</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên Khách Hàng</th>
            <th>Địa Chỉ</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Ghi Chú</th>
            <th>Trang Thái</th>
            <th>Tùy Chọn</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($orders))
          @foreach ($orders as $key => $order)
          <tr>
            <td>{{$key+1}}</td>
            <td>
              <ul style="list-style: none;">
                <li>Tên: {{$order -> name}}</li>
                <br>
                <li>Giá: {{number_format($order -> money, 0, ',', '.')}} VND</li>
              </ul>
            </td>
            <td>{{$order -> address}}</td>
            <td>{{$order -> email}}</td>
            <td>{{$order -> phone}}</td>
            <td>{{ $order -> note}}</td>
            <td>
              @if ($order -> status == 1)
              <a href="#" class="badge badge-success">Đã Xử Lý</a>
              @else
              <a href="{{ route('admin.get.order.action', $order -> id) }}" class="badge badge-secondary">chưa xử lý</a>
              @endif
            </td>
            <td>
              <button class="btn btn-primary edit" data-id="{{$order -> id}}" data-toggle="modal" data-target="#edit" type="button"><a href="{{ route('admin.get.order.detail', $order -> id) }}" title=""><i class="fas fa-eye" style="color: white"></i></a></button>
              <button class="btn btn-danger delete" data-id="{{$order -> id}}" data-toggle="modal" data-target="#delete" type="button"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
      {{$orders -> links()}}
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