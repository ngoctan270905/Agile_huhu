@extends('layouts.admin')

@section('content')
    <h1>Thông tin chi tiết sản phẩm</h1>

    <div class="row">
        <div class="col-4">
            <img style="width:300px; height:300px" src="" alt="">
        </div>
        <div class="col-8">
          <h2>Danh mục: <?= $product->category->ten_danh_muc ?></h2>
            <h2>Mã Sản Phẩm: <?= $product->ma_san_pham ?></h2>
            <h2>Tên sản phẩm: <?= $product->ten_san_pham ?></h2>
            <h2>Giá: <?= $product->gia ?></h2>
            <h2>Giá Khuyến Mãi: <?= $product->gia_khuyen_mai ?></h2>
            <h2>Số Lượng: <?= $product->so_luong ?></h2>

        </div>

    </div>
@endsection
