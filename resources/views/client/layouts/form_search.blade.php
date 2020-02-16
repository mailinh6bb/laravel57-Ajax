   <ul class="cart-list">
   	@if (isset($products))
   	@foreach ($products as  $pro)
   	<li style="margin-top: 5px; padding-left: 20px; display: flex;">
   		<div>
   			<a class="sm-cart-product"  href="{{ route('get.product.detail', [$pro -> id, $pro -> slug]) }}" style="margin-right: 20px;">
   			<img src="{{ asset('/upload/image_product/file/'.$pro -> avatar) }}" width="50px" height="50px" alt="" >
   		</a>
   		</div>
   		
   		<div class="small-cart-detail">
   			<a class="small-cart-name"  href="{{ route('get.product.detail', [$pro -> id, $pro -> slug]) }}">{{$pro -> name}}</a>
   			<span class="quantitys">Giá:<span>{{$pro -> price}}</span> VND</span>
   		</div>
   	</li>
   	@endforeach
   	@endif
   </ul>


