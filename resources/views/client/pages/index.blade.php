@extends('client.layouts.master')
@section('title')
Trang chủ
@endsection

@section('slide')
@include('client.layouts.slide')
@endsection

@section('content')
<style>
	.heading-tittle {
		margin-top: 25px;
	}
</style>
<div class="row">
	<!-- product left -->
	<div class="product_content" style="width: 100%">
		@if (isset($protypeMen))
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center" style="padding-bottom: 10px;">
			<span>T</span>hời
			<span>T</span>rang
			<span>N</span>am
		</h3>
		<!-- //tittle heading -->
		<div class="wrapper">
			<!-- first section -->
			<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
				@foreach($protypeMen as $pro_men)
				<h3 class="heading-tittle text-center font-italic">
					{{ $pro_men -> name}}
				</h3>
				
				<div class="row">
					@if (isset($pro_men -> products))
					<?php $i = 0;?> 
					@foreach($pro_men -> products as $pro)
					<div class="col-md-3 product-men mt-5">
						<div class="men-pro-item simpleCart_shelfItem">
							@if ($pro -> qty == 0)
							<span style="position: absolute; background: #e91e63; color: white; border-radius: 4px; font-size: 10px; padding: 5px 10px;z-index: 100; left: 20px;">Tạm Hết Hàng</span>
							@endif
							@if  ( $pro ->sale > 0 && $pro -> qty > 0)
							<span class="sale_item" style="position: absolute; font-size: 11px; background-image: linear-gradient(-250deg,#ec1f1f 0%,#ff9c00 100%); border-radius: 10px; padding: 5px 10px; color: white; z-index: 100; left: 20px;" >Giảm: {{$pro ->sale}}%</span>
							@endif
							<div class="men-thumb-item text-center">
								<img src="{{ asset('upload/image_product/file/'.$pro-> avatar) }}" class="img-fluid" alt="{{ $pro -> name }}">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="{{ route('get.product.detail', [$pro -> id, $pro -> slug]) }}" class="link-product-add-cart">Chi tiết</a>
									</div>
								</div>
							</div>
							<div class="item-info-product text-center border-top mt-4">
								<h4 class="pt-1">
									<a href="{{ $pro->slug }}.html">{{ $pro->name }}</a>
								</h4>
								<div class="info-product-price my-2">
									@if($pro->promotional>0)
									<span class="item_price">
										{{ number_format($pro->promotional) }}
									</span>
									<del>{{ number_format($pro->price) }}</del>
									@else
									<span class="item_price">
										{{ number_format($pro->price) }}
									</span>
									@endif
								</div>
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
									<a href="{{ route('add.cart', $pro -> id) }}">Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
					{{-- giới hạn số lượng sản phẩm --}}
					<?php
					if (++$i == 6) break;
					?>
					@endforeach	
					@endif
				</div>
				@endforeach
			</div>
			<!-- //first section -->
		</div>
		@endif
		
		@if (isset($protypeWoman))
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center" style="padding-bottom: 10px;">
			<span>T</span>hời
			<span>T</span>rang
			<span>N</span>ữ
		</h3>
		<!-- //tittle heading -->
		<div class="wrapper">
			<!-- first section -->
			<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
				@foreach($protypeWoman as $pro_woman)
				<h3 class="heading-tittle text-center font-italic">
					{{ $pro_woman -> name}}
				</h3>
				
				<div class="row">
					@if (isset($pro_woman -> products))
					<?php $i = 0;?> 
					@foreach($pro_woman -> products as $pro)
					<div class="col-md-3 product-men mt-5">
						<div class="men-pro-item simpleCart_shelfItem">
							@if ($pro -> qty == 0)
							<span style="position: absolute; background: #e91e63; color: white; border-radius: 4px; font-size: 10px; padding: 5px 10px;z-index: 100; left: 20px;">Tạm Hết Hàng</span>
							@endif
							@if  ( $pro ->sale > 0 && $pro -> qty > 0)
							<span class="sale_item" style="position: absolute; font-size: 11px; background-image: linear-gradient(-250deg,#ec1f1f 0%,#ff9c00 100%); border-radius: 10px; padding: 5px 10px; color: white; z-index: 100; left: 20px;" >Giảm: {{$pro ->sale}}%</span>
							@endif
							<div class="men-thumb-item text-center">
								<img src="{{ asset('upload/image_product/file/'.$pro-> avatar) }}" class="img-fluid" alt="{{ $pro -> name }}">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="{{ $pro->slug }}.html" class="link-product-add-cart">Chi tiết</a>
									</div>
								</div>
							</div>
							<div class="item-info-product text-center border-top mt-4">
								<h4 class="pt-1">
									<a href="{{ $pro->slug }}.html">{{ $pro->name }}</a>
								</h4>
								<div class="info-product-price my-2">
									@if($pro->promotional>0)
									<span class="item_price">
										{{ number_format($pro->promotional) }}
									</span>
									<del>{{ number_format($pro->price) }}</del>
									@else
									<span class="item_price">
										{{ number_format($pro->price) }}
									</span>
									@endif
								</div>
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
									<a href="{{ route('add.cart', $pro -> id) }}">Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
					{{-- giới hạn số lượng sản phẩm --}}
					<?php
					if (++$i == 6) break;
					?>
					@endforeach	
					@endif
				</div>
				@endforeach
			</div>
			<!-- //first section -->
		</div>
		@endif

		

		@if (isset($protypeAcces))
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center" style="padding-bottom: 10px;">
			<span>P</span>hụ
			<span>K</span>iện
		</h3>
		<!-- //tittle heading -->
		<div class="wrapper">
			<!-- first section -->
			<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">

				@foreach($protypeAcces as $pro_acces)
				<h3 class="heading-tittle text-center font-italic">
					@if (count($pro_acces -> products) > 0)
					{{ $pro_acces -> name}}
					@endif
				</h3>
				
				<div class="row">
					@if (isset($pro_acces -> products))
					<?php $i = 0;?> 
					@foreach($pro_acces -> products as $pro)
					<div class="col-md-3 product-men mt-5">
						<div class="men-pro-item simpleCart_shelfItem">
							@if ($pro -> qty == 0)
							<span style="position: absolute; background: #e91e63; color: white; border-radius: 4px; font-size: 10px; padding: 5px 10px;z-index: 100; left: 20px;">Tạm Hết Hàng</span>
							@endif
							@if  ( $pro ->sale > 0 && $pro -> qty > 0)
							<span class="sale_item" style="position: absolute; font-size: 11px; background-image: linear-gradient(-250deg,#ec1f1f 0%,#ff9c00 100%); border-radius: 10px; padding: 5px 10px; color: white; z-index: 100; left: 20px;" >Giảm: {{$pro ->sale}}%</span>
							@endif
							<div class="men-thumb-item text-center">
								<img src="{{ asset('upload/image_product/file/'.$pro-> avatar) }}" class="img-fluid" alt="{{ $pro -> name }}">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="{{ $pro->slug }}.html" class="link-product-add-cart">Chi tiết</a>
									</div>
								</div>
							</div>
							<div class="item-info-product text-center border-top mt-4">
								<h4 class="pt-1">
									<a href="{{ $pro->slug }}.html">{{ $pro->name }}</a>
								</h4>
								<div class="info-product-price my-2">
									@if($pro->promotional>0)
									<span class="item_price">
										{{ number_format($pro->promotional) }}
									</span>
									<del>{{ number_format($pro->price) }}</del>
									@else
									<span class="item_price">
										{{ number_format($pro->price) }}
									</span>
									@endif
								</div>
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
									<ahref="{{ route('add.cart', $pro -> id) }}">Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
					{{-- giới hạn số lượng sản phẩm --}}
					<?php
					if (++$i == 6) break;
					?>
					@endforeach	
					@endif
				</div>
				@endforeach
			</div>
			<!-- //first section -->
		</div>
		@endif
		

		@if (isset($protypeShoes))
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center" style="padding-bottom: 10px;">
			<span>G</span>iày
			<span>D</span>ép
		</h3>
		<!-- //tittle heading -->
		<div class="wrapper">
			<!-- first section -->
			<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
				@foreach($protypeShoes as $pro_shoes)
				<h3 class="heading-tittle text-center font-italic">
					@if (count($pro_shoes -> products) > 0)
					{{ $pro_shoes -> name}}
					@endif
				</h3>
				
				<div class="row">
					@if (isset($pro_shoes -> products))
					<?php $i = 0; ?>
					@foreach($pro_shoes -> products as $pro)
					<div class="col-md-3 product-men mt-5">
						<div class="men-pro-item simpleCart_shelfItem">
							@if ($pro -> qty == 0)
							<span style="position: absolute; background: #e91e63; color: white; border-radius: 4px; font-size: 10px; padding: 5px 10px;z-index: 100; left: 20px;">Tạm Hết Hàng</span>
							@endif
							@if  ( $pro ->sale > 0 && $pro -> qty > 0)
							<span class="sale_item" style="position: absolute; font-size: 11px; background-image: linear-gradient(-250deg,#ec1f1f 0%,#ff9c00 100%); border-radius: 10px; padding: 5px 10px; color: white; z-index: 100; left: 20px;" >Giảm: {{$pro ->sale}}%</span>
							@endif
							<div class="men-thumb-item text-center">
								<img src="{{ asset('upload/image_product/file/'.$pro-> avatar) }}" class="img-fluid" alt="{{ $pro -> name }}">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="{{ $pro->slug }}.html" class="link-product-add-cart">Chi tiết</a>
									</div>
								</div>
							</div>
							<div class="item-info-product text-center border-top mt-4">
								<h4 class="pt-1">
									<a href="{{ $pro->slug }}.html">{{ $pro->name }}</a>
								</h4>
								<div class="info-product-price my-2">
									@if($pro->promotional>0)
									<span class="item_price">
										{{ number_format($pro->promotional) }}
									</span>
									<del>{{ number_format($pro->price) }}</del>
									@else
									<span class="item_price">
										{{ number_format($pro->price) }}
									</span>
									@endif
								</div>
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
									<a href="{{ route('add.cart', $pro -> id) }}">Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
					{{-- giới hạn số lượng sản phẩm --}}
					<?php
					if (++$i == 6) break;
					?>
					@endforeach	
					@endif
				</div>
				@endforeach
			</div>
			<!-- //first section -->
		</div>
		@endif
		
	</div>
	<!-- product right -->
	{{-- @include('client.layouts.sidebar') --}}
</div>
@endsection