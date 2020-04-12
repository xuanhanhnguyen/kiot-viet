<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cham_cong extends Model
{
    //
    protected $table = "cham_cong";
    protected $fillable = ['user_id', 'ngay_cong', 'thang', 'nam', 'gi_chu'];
    public $timestamps = true;
}
