@extends('client.layouts.master')

@section('title')
Đặt Hàng
@endsection

@section('content')
<div class="page-head_agile_info_w3l">
</div>
<!-- //banner-2 -->
<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="/">Trang Chủ</a>
                    <i>|</i>
                </li>
                <li>Đặt Hàng</li>
            </ul>
        </div>
    </div>
</div>
<br/>


<form method="post">
 <div class="row">
    <div class="col-sm-8">
      <div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);margin-top: 10px;">
        <div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
            <div class="vertical_post check_box_agile">
                <h5><i class="fas fa-shopping-cart"></i> Đơn Hàng Của Bạn</h5>
                <div class="table-responsive">
                    <table class="timetable_sub">
                        <thead>
                            <tr>
                                <th>Hình Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $value)
                            <tr class="rem1">
                                <td class="invert-image">
                                    <a href="#">
                                        <img src="{{asset('upload/image_product/file/'.$value->options->avatar) }}" height="80" alt="{{ $value->name }}" class="img-responsive">
                                    </a>
                                </td>
                                <td class="invert">{{ $value->name }}</td>
                                <td class="invert">
                                  {{ $value->qty }}
                              </td>
                              <td class="invert">{{ number_format($value->price, 0, ',', '.') }} VNĐ</td>
                              <td>{{number_format($value-> qty * $value -> price, 0, ',', '.')}} VNĐ</td>
                          </tr>
                          @endforeach 
                      </tbody>
                  </table>
                  <a href="{{ route('cart.index') }}" style="float: right; padding-top: 10px;">xem lại giỏ hàng >></a>
              </div>
          </div>
      </div>
  </div>
  <div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);">
    <div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
        <div class="vertical_post check_box_agile">
            <h5 style="float: left;"><i class="fas fa-map-marker-alt"></i> Địa chỉ nhận hàng</h5>
            <a href="#address" style="float: right;" data-toggle="modal">Thay đổi >></a>
            <div class="checkbox" style=" clear: both;">
               @if( count($user->customer) >0 )
               @foreach( $user->customer as $key => $cus )
               <div class="check_box_one cashon_delivery">
                <label class="anim">
                    {{-- kiểm tra xem người dung có địa chỉ trc đó chưa --}}

                    <ul style="list-style: none;"> 

                        <li>
                            <input type="radio" class="rdoAddress" name="rdoaddress" @if($cus->active == 1) checked @endif value="{{$cus->email}}" style="float: left;">
                            <span style="float: left;">
                                <i class="name{{ $key }}">{{ $cus->name }}</i> | <i class="phone{{$key}}">{{ $cus->phone }}</i>
                                <p class="address{{$key}}">{{ $cus->address }}</p>
                            </span>
                        </li> 

                    </ul>

                </label>
            </div>
            @endforeach 
            @else
            {{ 'Bạn chưa thêm địa chỉ nhận hàng' }}
            @endif       
        </div>
    </div>
</div>
</div>
<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);margin-top: 10px;">
    <div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
        <div class="vertical_post check_box_agile">
            <h5><i class="far fa-truck"></i> Phương thức vận chuyển</h5>
            <div class="checkbox">
                <div class="check_box_one cashon_delivery">
                    <label class="anim">
                        <input type="checkbox" class="checkbox" checked style="float: left;">
                        <span style="float: left;">
                            Chuyển phát tiêu chuẩn
                            <p>Dự kiến giao hàng sau 3-4 ngày</p>
                        </span>
                        <span style="float: right; margin-left: 240px;">{{ number_format('20000') }} VNĐ</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-sm-4">
    <div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);">
        <div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
            <div class="vertical_post check_box_agile">
                <h5 style="text-align: center;"><i class="fas fa-shopping-cart"></i>Tiền Và Phí Vận Chuyển</h5>
                <div class="checkbox">
                    <div class="check_box_one cashon_delivery">
                        <label class="anim">
                            <p style="float: left;font-weight: bold;">Tổng Tiền</p>
                            <p style="margin-left: 10px;float: left;">{{ number_format($price, 0, ',', '.') }} VNĐ</p>
                        </label>
                        <label class="anim">
                            <p style="float: left;font-weight: bold;">Phí vận chuyển</p>
                            <p style="margin-left: 10px;float: left;">{{$phi =  number_format(20000, 0, ',', '.') }} VNĐ</p>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193); margin-top: 10px;">
        <div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
            <div class="vertical_post check_box_agile">
                <div class="checkbox">
                    <div class="check_box_one cashon_delivery">
                        <label class="anim">
                            <h5 class="modal-title text-center"><i class="fas fa-comments"></i> Ghi Chú</h5>
                            <div class="form-group">
                                <textarea style="width: 247px;" class="note" name="note" placeholder="Bạn có nhắn gì tới shop không?" rows="4" maxlength="1000"></textarea>
                            </div>

                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193); margin-top: 10px;">
        <div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
            <div class="vertical_post check_box_agile">
                <div class="checkbox">
                    <div class="check_box_one cashon_delivery">
                        <label class="anim">
                            <p style="float: left;font-weight: bold;">Tổng thanh toán</p>
                            <p style="margin-left: 3px;float: left;" class="paytotal">{{ number_format($price+20000,0,',','.')}} VNĐ</p>
                        </label>
                        <label class="anim">
                            <button type="button" class="btn submit check_out payment">Tiến hành thanh toán</button>
                            <hr>
                            <i>(Quá Trình Thanh Toán Sẽ Mất Chút Thời Gian. Bạn Vui Lòng Đợi Trong Giây Lát)</i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
</div>
</form> 

{{-- Modal thay đổi đia chỉ nhận hàng    --}}
<div class="modal fade" id="address" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Thay đổi địa chỉ giao hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label class="col-form-label">Địa Chỉ Email</label>
                        <input type="text" class="form-control email" value="{{ $user->email ?? '' }}" placeholder="Nhập địa chỉ email" name="email" required="">
                        <label class="col-form-label errorEmail" style="color: red;"></label>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Họ Tên</label>
                        <input type="text" class="form-control name" placeholder="Nhập họ tên" name="name" required="">
                        <label class="col-form-label errorName" style="color: red;"></label>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Số điện thoại</label>
                        <input type="text" class="form-control phone" placeholder="Nhập số điện thoại" name="phone" required="">
                        <label class="col-form-label errorPhone" style="color: red;"></label>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Địa Chỉ</label>
                        <input type="text" class="form-control address" placeholder="Nhập địa chỉ nhận hàng" name="address" required="">
                        <label class="col-form-label errorAddress" style="color: red;"></label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="actives" name="active" checked >
                        <label class="" for="customControlAutosizing" >Dùng địa chỉ này cho các đơn hàng sau</label>
                    </div>
                    <div class="right-w3l">
                        <button type="button" class="btn btn-primary form-control addAddress">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
