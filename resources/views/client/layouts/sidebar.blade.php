<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
    <div class="side-bar p-sm-4 p-3">
        <div class="search-hotel border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Search Here..</h3>
            <form action="#" method="post">
                <input type="search" placeholder="Product name..." name="search" required="">
                <input type="submit" value=" ">
            </form>
        </div>
        <!-- price -->
        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Giá</h3>
            <div class="w3l-range">
                <ul>
                    <li>
                        <a href="?price=1">dưới 200.000 vnd</a>
                    </li>
                    <li class="my-1">
                        <a href="#">từ 200.000-500.000 vnd</a>
                    </li>
                    <li>
                        <a href="#">từ 500.000-700.000 vnd</a>
                    </li>
                    <li class="my-1">
                        <a href="#">từ 700.000-1.000.000 vnd</a>
                    </li>
                    <li class="mt-1">
                        <a href="#">trên 1.000.000 vnd</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- //price -->
        <!-- price -->
        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Khuyến Mãi</h3>
            <div class="w3l-range">
                <ul>
                    <li>
                        <a href="#">5%</a>
                    </li>
                    <li class="my-1">
                        <a href="#">10%</a>
                    </li>
                    <li>
                        <a href="#">20%</a>
                    </li>
                    <li class="my-1">
                        <a href="#">30%</a>
                    </li>
                    <li>
                        <a href="#">50%</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- //price -->  <!-- price -->
        <div class="range border-bottom py-2">
            <h3 class="agileits-sear-head mb-3">Loại Sản Phẩm</h3>
            <div class="w3l-range">
                <ul>
                    <li>
                        <a href="#">Áo Khoác Nam</a>
                    </li>
                    <li class="my-1">
                        <a href="#">Áo Khoác Nữ</a>
                    </li>
                    <li>
                        <a href="#">Quần Short Nữ</a>
                    </li>
                    <li class="my-1">
                        <a href="#">Giày Đẹp</a>
                    </li>
                    <li>
                        <a href="#">Phụ Kiện Hot</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- //price -->
        <!-- best seller -->
        <div class="f-grid py-2">
            <h3 class="agileits-sear-head mb-3">Sản Phẩm Mới Nhất</h3>
            <div class="box-scroll">
                <div class="scroll">
                    @if (isset($productNew))
                    @foreach ($productNew as $pro)
                    <div class="row">
                        <div class="col-lg-4 col-sm-2 col-3 left-mar">
                            <img src="{{ asset('/upload/image_product/file/'.$pro -> avatar) }}" style="width: 100px; height: 100px" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-8 col-sm-10 col-9 w3_mvd">
                            <a href="">{{ $pro -> name}}</a>
                            <a href="" class="price-mar mt-2">{{ $pro -> price}}</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- //best seller -->
    </div>
    <!-- //product right -->
</div>