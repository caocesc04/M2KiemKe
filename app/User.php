<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "Users";
    protected $primaryKey = 'ID';
    
    protected $fillable = [
        'Username', 'Password', 'Permission', 'BietDanh', 'Ten', 'Status'
    ];
    public function kiemke() {
        return $this->hasMany('App\KiemKe','ID_Users','ID');
    }
    public function phancongkiemke() {
        return $this->hasMany('App\PhanCongKiemKe','ID_Users','ID');
    }
}