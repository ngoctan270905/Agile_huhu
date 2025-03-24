<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Để sử dụng được factory tạo dữ liệu ta cần phải sử dụng thư viện 
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'ten_danh_muc',
        'trang_thai'
    ];
    // Tạo mối liên hệ với product() {}
    public function product() {
        return $this->hasMany(Product::class, 'category_id');
    }
}
