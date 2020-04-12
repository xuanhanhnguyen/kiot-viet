<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class san_pham extends Model
{
    //
    protected $table = "san_pham";
    protected $fillable = ['ten_sp', 'so_luong', 'gia', 'sale', 'hinh_anh', 'mo_ta', 'trang_thai'];
    public $timestamps = true;
}
