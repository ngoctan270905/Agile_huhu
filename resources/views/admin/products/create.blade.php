@extends('layouts.admin')

@section('content')
    <h1>Thêm sản phẩm</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->ten_danh_muc }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- <!-- Mã sản phẩm -->
        <div class="mb-3">
            <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
            <input type="text" name="ma_san_pham" id="ma_san_pham"
                class="form-control @error('ma_san_pham') is-invalid @enderror" placeholder="Nhập mã sản phẩm"
                value="{{ old('ma_san_pham') }}">
            @error('ma_san_pham')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div> --}}

        <div class="mb-3">
            <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
            <input type="text" name="ma_san_pham" id="ma_san_pham"
                class="form-control" placeholder="Nhập mã sản phẩm">

        </div>


        <!-- Tên sản phẩm -->
        <div class="mb-3">
            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
            <input type="text" name="ten_san_pham" class="form-control" placeholder="Nhập tên sản phẩm">
        </div>

        <div class="mb-3">
            <label for="hinh_anh" class="form-label">Hình ảnh</label>
            <input type="file" name="hinh_anh" class="form-control">
        </div>

        <!-- Giá -->
        <div class="mb-3">
            <label for="gia" class="form-label">Giá (VND)</label>
            <input type="number" name="gia" class="form-control" placeholder="Nhập giá">
        </div>

        <!-- Giá khuyến mãi -->
        <div class="mb-3">
            <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi (VND)</label>
            <input type="number" name="gia_khuyen_mai" class="form-control" placeholder="Nhập giá khuyến mãi (nếu có)">
        </div>

        <!-- Số lượng -->
        <div class="mb-3">
            <label for="so_luong" class="form-label">Số lượng</label>
            <input type="number" name="so_luong" class="form-control" placeholder="Nhập số lượng">
        </div>

        <!-- Ngày nhập -->
        <div class="mb-3">
            <label for="ngay_nhap" class="form-label">Ngày nhập</label>
            <input type="date" name="ngay_nhap" class="form-control">
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô tả</label>
            <textarea name="mo_ta" class="form-control" placeholder="Nhập mô tả sản phẩm"></textarea>
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <select name="trang_thai" id="trang_thai" class="form-control">
                <option value="1" {{ old('trang_thai', 1) == 1 ? 'selected' : '' }}>Còn hàng</option>
                <option value="0" {{ old('trang_thai') == 0 ? 'selected' : '' }}>Hết hàng</option>
            </select>
        </div>



        <div>
            <button type="submit" class="btn btn-success">Thêm</button>
        </div>

    </form>
@endsection
