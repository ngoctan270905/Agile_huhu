<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'category_id',
        'hinh_anh',
        'gia',
        'gia_khuyen_mai',
        'so_luong',
        'ngay_nhap',
        'mo_ta',
        'trang_thai',

    ];
    // Tạo mối liên hệ với danh mục
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
