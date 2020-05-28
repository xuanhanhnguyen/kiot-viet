<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cua_hang extends Model
{
    //
    protected $table = "cua_hang";
    protected $fillable = ['ten', 'dia_chi', 'hinh_anh'];
    public $timestamps = false;

}
