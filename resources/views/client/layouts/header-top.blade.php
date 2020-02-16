<div class="agile-main-top">
	<div class="container-fluid">
		<div class="row main-top-w3l py-2">
			<div class="col-lg-4 header-most-top">
				<p class="text-white text-lg-left text-center">Shop Uy Tín Về Chất Lượng và Giá Cả!
				</p>
			</div>
			<div class="col-lg-8 header-right mt-lg-0 mt-2">
				<!-- header lists -->
				<ul>
					<li class="text-center border-right text-white">
						<a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
							<i class="fas fa-map-marker mr-2"></i>Nhiều Ưu Đãi
						</a>
					</li>
					<li class="text-center border-right text-white">
						<a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
							<i class="fas fa-truck mr-2"></i>Giao Hàng Nhanh
						</a>
					</li>
					<li class="text-center border-right text-white">
						<i class="fas fa-phone mr-2"></i> 0865565716
					</li>
					@if(Auth::check())
					<li class="text-center border-right ">
						<a href="{{ route('get.logout') }}" title="Đăng Xuất" class="text-white"><i class="fas fa-sign-in-alt mr-2"></i>{{ Auth::user()->name }}</a>
					</li>
					@else
					<li class="text-center border-right text-white">
						<a href="#" data-toggle="modal" data-target="#login" class="text-white">
							<i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập 
						</a>
					</li>
					<li class="text-center text-white">
						<a href="#" data-toggle="modal" data-target="#register" class="text-white">
							<i class="fas fa-sign-out-alt mr-2"></i>Đăng Ký 
						</a>
					</li>

					@endif
				</ul>
				<!-- //header lists -->
			</div>
		</div>
	</div>
</div>