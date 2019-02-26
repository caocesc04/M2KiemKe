<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhanCongKiemKe extends Model
{
    protected $table = "PhanCongKiemKe";
    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID_Kho', 'ID_Users', 'NgayBatDau', 'Status', 'created_at'
    ];
    public function user() {
        return $this->belongsTo('App\User','ID_Users','ID');
    }
    public function kho() {
        return $this->belongsTo('App\Kho','ID_Kho','MaKho');
    }
}
