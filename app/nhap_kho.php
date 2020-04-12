<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhap_kho extends Model
{
    //
    protected $table = "nhap_kho";
    protected $fillable = ['khach_hang_id', 'san_pham_id', 'sl_nhap'];
    public $timestamps = true;
}
