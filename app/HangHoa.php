<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HangHoa extends Model
{
    protected $table = "HangHoa";
    protected $primaryKey = 'HangHoaID';
    public $incrementing = false;

	public function kiemke() {
        return $this->hasMany('App\KiemKe','ID_HangHoa','HangHoaID');
    }
}
