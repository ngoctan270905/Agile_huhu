<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách sản phẩm có phân trang và kèm theo danh mục
        $query = Product::with('category');
        if ($request->filled('ma_san_pham')) {
            $query->where('ma_san_pham', 'LIKE', '%' . $request->ten_san_pham . '%');
        }
        if ($request->filled('ten_san_pham')) {
            $query->where('ten_san_pham', 'LIKE', '%' . $request->ten_san_pham . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('gia_tu')) {
            $query->where('gia', '>=', (int) $request->gia_tu);
        }
        // 🔹 Lọc theo ngày nhập
        if ($request->filled('ngay_nhap_tu')) {
            $query->whereDate('ngay_nhap', '>=', $request->ngay_nhap_tu);
        }

        if ($request->filled('ngay_nhap_den')) {
            $query->whereDate('ngay_nhap', '<=', $request->ngay_nhap_den);
        }

        if ($request->filled('gia_den')) {
            $query->where('gia', '<=', (int) $request->gia_den);
        }
        // Tương tự thực hiện tim kiếm sản phẩm theo:
        // Tên sản phẩm, Danh mục, Khoảng giá, Ngày nhập, Trạng thái
        $products = $query->paginate(10);
        $categories = Category::all();
        // Trả về view admin.products.index và truyền biến $products
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        // Lấy ra dữ liệu chi tiết theo id
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));

        // Đổ dữ liệu thông tin chi tiết ra giao diện
    }

    public function create()
    {
        // Lấy ra dữ liệu chi tiết theo id
        $product = Product::with('category');
        $categories = Category::all();
        return view('admin.products.create', compact('product', 'categories'));

        // Đổ dữ liệu thông tin chi tiết ra giao diện
    }

    public function store(Request $request) {
        // Khởi tạo 1 đối tượng Product mới 
        $product = new Product();

        // Lấy dữ liệu từ form
        $product->ma_san_pham = $request->ma_san_pham;
        $product->ten_san_pham = $request->ten_san_pham;
        $product->category_id = $request->category_id;
        $product->hinh_anh = $request->hinh_anh;
        $product->gia = $request->gia;
        $product->gia_khuyen_mai = $request->gia_khuyen_mai;
        $product->so_luong = $request->so_luong;
        $product->ngay_nhap = $request->ngay_nhap;
        $product->mo_ta = $request->mo_ta;
        $product->trang_thai = $request->trang_thai;

        // Xử lí hình ảnh
        if($request->hasFile('hinh_anh')) {
            $imagePath = $request->file('hinh_anh')->store('images/products', 'public');
            $product->hinh_anh = $imagePath;
        }

        // Lưu sản phẩm
        $product->save();

        


        return redirect()->route('admin.products.index');
    }

    // public function store(Request $request) {
    //     // Khởi tạo 1 đối tượng Product mới 
    //     $product = new Product();

    //     // Lấy dữ liệu từ form
    //     $product->ma_san_pham = $request->ma_san_pham;
    //     $product->ten_san_pham = $request->ten_san_pham;
    //     $product->category_id = $request->category_id;
    //     $product->hinh_anh = $request->hinh_anh;
    //     $product->gia = $request->gia;
    //     $product->gia_khuyen_mai = $request->gia_khuyen_mai;
    //     $product->so_luong = $request->so_luong;
    //     $product->ngay_nhap = $request->ngay_nhap;
    //     $product->mo_ta = $request->mo_ta;
    //     $product->trang_thai = $request->trang_thai;

    //     // Xử lí hình ảnh
    //     if($request->hasFile('hinh_anh')) {
    //         $imagePath = $request->file('hinh_anh')->store('images/products', 'public');
    //         $product->hinh_anh = $imagePath;
    //     }

    //     // Lưu sản phẩm
    //     $product->save();

        


    //     return redirect()->route('admin.products.index');
    // }
    // Validate
        // $dataValidate = $request->validate([
        // 'ma_san_pham'     => 'required|string|max:20|unique:products,ma_san_pham',
        // 'ten_san_pham'    => 'required|string|max:255',
        // 'category_id'     => 'required|exists:categories,id',
        // 'hinh_anh'        => 'nullable|image|mimes:jpg,png,ipeg,gif',
        // 'gia'             => 'required|numeric|min:0,max:99999999',
        // 'gia_khuyen_mai'  => 'nullable|numeric|min:0,lt:gia',
        // 'so_luong'        => 'required|integer|min:1',
        // 'ngay_nhap'       => 'required|date',
        // 'mo_ta'           => 'nullable|string',
        // 'trang_thai'      => 'required|boolean'
        // ]);

        // // Xử lí hình ảnh
        // if($request->hasFile('hinh_anh')) {
        //     $imagePath = $request->file('hinh_anh')->store('images/products', 'public');
        //     $dataValidate['hinh_anh'] = $imagePath;
        // }
        // Product::create($dataValidate);

    
}
