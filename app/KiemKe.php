<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KiemKe extends Model
{
    protected $table = "KiemKeHangHoa";
    protected $primaryKey = 'ID';

    public function user() {
        return $this->belongsTo('App\User','ID_Users','ID');
    }
    public function hanghoa() {
        return $this->belongsTo('App\HangHoa','ID_HangHoa','HangHoaID');
    }
    public function kho() {
        return $this->belongsTo('App\Kho','ID_Kho','MaKho');
    }
}
