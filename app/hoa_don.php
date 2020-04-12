<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hoa_don extends Model
{
    //
    protected $table = "hoa_don";
    protected $fillable = ['khach_hang_id', 'tong_tien', 'create_by'];
    public $timestamps = true;

    public function khach_hang()
    {
        return $this->hasOne('App\khach_hang', 'id', 'khach_hang_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'create_by');
    }
}
