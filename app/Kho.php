<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kho extends Model
{
    protected $table = "Kho";
    protected $primaryKey = 'MaKho';
    public $incrementing = false;

    public function phancongkiemke() {
        return $this->hasMany('App\PhanCongKiemKe','ID_Kho','MaKho');
    }
    public function kiemke() {
        return $this->hasMany('App\KiemKe','ID_Kho','MaKho');
    }
}
