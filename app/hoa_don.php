<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hoa_don extends Model
{
    //
    protected $table = "hoa_don";
    protected $fillable = ['khach_hang_id', 'tong_tien', 'create_by'];
    public $timestamps = true;
}
