<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khach_hang extends Model
{
    //
    protected $table = "khach_hang";
    protected $fillable = ['ten_kh', 'dia_chi', 'email', 'dien_thoai', 'loai_kh', 'trang_thai'];
    public $timestamps = true;
}
