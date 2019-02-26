<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{
    public function index()
    {
        //
    }

    public function editnv(Request $req)
    {
        $users = User::select('ID','Username','Password','Ten','BietDanh','Status')->find($req->id);
        $users->Username = $req->username;
        $users->Password = $req->password;
        $users->Ten = (mb_detect_encoding($req->tennhanvien, mb_detect_order(), true) === 'UTF-8') 
            ? $req->tennhanvien : iconv('iso-8859-1', 'utf-8', $req->tennhanvien);        
        $users->BietDanh = (mb_detect_encoding($req->bietdanh, mb_detect_order(), true) === 'UTF-8') 
            ? $req->bietdanh : iconv('iso-8859-1', 'utf-8', $req->bietdanh);
        $users->save();
        return response()->json($users);
    }
    public function deletenv(Request $req) {
        User::find ( $req->id )->delete ();
        return response ()->json ();
    }
    public function changestatus(Request $req) {
        $users = User::select('ID','Status')->find($req->id);
        if($users->Status == 0){
            $users->Status = '1';
        }else{
            $users->Status = '0';
        }
        $users->save();
        $users = User::select('ID','Username','Password','Ten','BietDanh','Status')->find($req->id);
        return response()->json($users);
    }
}
