@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Danh sách sản phẩm</h2>
        <a href="{{ route('admin.products.create')}}" class="btn btn-success">Thêm sản phẩm</a>
        <!-- Form tìm kiếm -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm sản phẩm</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.products.index') }}">
                    <div class="row g-3">
                        <!-- Mã sản phẩm -->
                        <div class="col-md-3">
                            <label class="form-label">Mã sản phẩm</label>
                            <input type="text" name="ma_san_pham" class="form-control" placeholder="Nhập mã sản phẩm"
                                value="{{ request('ma_san_pham') }}">
                        </div>

                        <!-- Tên sản phẩm -->
                        <div class="col-md-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" name="ten_san_pham" class="form-control" placeholder="Nhập tên sản phẩm"
                                value="{{ request('ten_san_pham') }}">
                        </div>

                        <!-- Danh mục -->
                        <div class="col-md-3">
                            <label class="form-label">Danh mục</label>
                            <select name="category_id" class="form-control">
                                <option value="">Tất cả</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->ten_danh_muc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Giá từ</label>
                            <input type="number" name="gia_tu" class="form-control" placeholder="Nhập giá từ"
                                value="{{ request('gia_tu') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Giá đến</label>
                            <input type="number" name="gia_den" class="form-control" placeholder="Nhập giá đến"
                                value="{{ request('gia_den') }}">
                        </div>

                        <!-- Ngày nhập từ -->
                        <div class="col-md-3">
                            <label class="form-label">Ngày nhập từ</label>
                            <input type="date" name="ngay_nhap_tu" class="form-control"
                                value="{{ request('ngay_nhap_tu') }}">
                        </div>

                        <!-- Ngày nhập đến -->
                        <div class="col-md-3">
                            <label class="form-label">Ngày nhập đến</label>
                            <input type="date" name="ngay_nhap_den" class="form-control"
                                value="{{ request('ngay_nhap_den') }}">
                        </div>

                        <!-- Nút tìm kiếm & Làm mới -->
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100 me-1">
                                <i class="fas fa-search"></i> Tìm kiếm
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 ms-1">
                                <i class="fas fa-sync"></i> Làm mới
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Giá Khuyến Mãi</th>
                    <th>Số Lượng</th>
                    <th>Ngày Nhập</th>
                    <th>Hình Ảnh</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->ma_san_pham }}</td>
                        <td>{{ $product->ten_san_pham }}</td>
                        <td>{{ $product->category->ten_danh_muc }}</td>
                        <td>{{ number_format($product->gia, 0, ',', '.') }} VND</td>
                        <td>{{ $product->gia_khuyen_mai ? number_format($product->gia_khuyen_mai, 0, ',', '.') . ' VND' : 'Không' }}
                        </td>
                        <td>{{ $product->so_luong }}</td>
                        <td>{{ $product->ngay_nhap }}</td>
                        <td>
                            <img src="{{ asset($product->hinh_anh) }}" alt="Hình ảnh" width="80">
                        </td>
                        <td>
                            @if ($product->so_luong > 0)
                                <span class="badge bg-success">Còn hàng</span>
                            @else
                                <span class="badge bg-danger">Hết hàng</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="#" class="btn btn-primary btn-sm">Sửa</a>
                            <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-3">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
