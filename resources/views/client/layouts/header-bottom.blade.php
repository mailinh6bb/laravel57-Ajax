<div class="header-bot">
	<div class="container">
		<div class="row header-bot_inner_wthreeinfo_header_mid">
			<!-- logo -->
			<div class="col-md-4 logo_agile">
				<h1 class="text-center">
					<a href="{{ route('home') }}" class="font-weight-bold font-italic">
						<img src="/client_theme/images/logo2.png" style="height: 100px;" alt=" " class="img-fluid"> Mai Linh Shop 
					</a>
				</h1>
			</div>
			<!-- //logo -->
			<!-- header-bot -->
			<div class="col-md-8 header mt-4 mb-md-0 mb-4">
				<div class="row">
					<!-- search -->
					<div class="col-10 agileits_search">
						<form class="form-inline" action="#" method="post">
							<input class="form-control mr-sm-2" id="keySearch" name="search" type="search" placeholder="Tìm Kiếm Sản Phẩm" aria-label="Search" required>
							<button class="btn my-2 my-sm-0" type="submit">Tìm Kiếm</button>
						</form>
					</div>
					<div id="form_search" style="position: absolute; top: 50px; left: 20px; z-index: 1000; width: 450px; background: #f2f2f2">
					</div>
					<!-- //search -->
					<!-- cart details -->
					<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
						<div class="wthreecartaits wthreecartaits2 cart cart box_1">
							<a @if(Auth::check()) href=" {{ route('cart.index') }} " @else data-toggle="modal" data-target="#login" href="#" @endif title="Giỏ hàng bạn có {{ \Cart::count() }} mặt hàng" class="btn w3view-cart">
								<i class="fas fa-cart-arrow-down"></i>
							</a>
						</div>
					</div>
					<!-- //cart details -->
				</div>
			</div>
		</div>
	</div>
</div>	
@section('script')
<script>
	$('#keySearch').keyup(function(){
		let key = $(this).val();
		let urlSearch = '{{ route('get.search.product') }}'
		if (key == "") {
			$("#form_search").css("display", 'none');
		}
		else {
			$.ajax({
				url: urlSearch,
				data: {
					key:key
				},
				method: 'GET',
				success:function(data){
					$("#form_search").html("").append(data.data);
					$("#form_search").css("display", 'block');
				}
			});
		}
		

	});
</script>
@stop