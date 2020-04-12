<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cthd extends Model
{
    //
    protected $table = "cthd";
    protected $fillable = ['hoa_don_id', 'san_pham_id', 'sl_mua'];
    public $timestamps = true;

    public function san_pham()
    {
        return $this->hasOne('App\san_pham', 'id', 'san_pham_id');
    }
}
