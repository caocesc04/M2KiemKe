<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\HangHoa;
use App\Kho;
use App\KiemKe;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class KiemKeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('Permission', 2)->get();
        $kiemke = KiemKe::select('ID_HangHoa')->selectRaw('sum(SoLuong) as SoLuong')->groupBy('ID_HangHoa')->get();
        return view('kiemke', compact('kiemke', 'user'));
    }
    public function indexcuahang()
    {
        $kho = Kho::all();
        $user = User::where('Permission', 2)->get();
        $kiemke = KiemKe::select('ID_HangHoa')->selectRaw('sum(SoLuong) as SoLuong')->groupBy('ID_HangHoa')->get();
        return view('kiemkecuahang', compact('kiemke', 'user', 'kho'));
    }
    public function indexnhanvien()
    {
        $user = User::where('Permission', 2)->get();
        $kiemke = KiemKe::where('ID_Users', 2)->get();
        return view('kiemkenhanvien', compact('kiemke', 'user'));
    }
    public function indexchitietmhkh()
    {
        $nhanvien = User::where('Permission', 2)->get();
        $kho = Kho::get();
        return view('chitietmhkh', compact('kho','nhanvien'));
    }
    public function kiemkehethong(Request $req)
    {
        $kiemke = KiemKe::with('hanghoa')->select('ID_HangHoa')->selectRaw('sum(SoLuong) as SoLuong')->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->groupBy('ID_HangHoa')->get();
        return response()->json($kiemke);
    }
    public function kiemkecuahang(Request $req)
    {
        if ($req->kho == 1) {
            $kiemke = KiemKe::with('hanghoa')->select('ID_HangHoa')->selectRaw('sum(SoLuong) as SoLuong')->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->groupBy('ID_HangHoa')->get();
        } else {
            $kiemke = KiemKe::with('hanghoa')->select('ID_HangHoa')->selectRaw('sum(SoLuong) as SoLuong')->where('ID_Kho', $req->kho)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->groupBy('ID_HangHoa')->get();
        }
        return response()->json($kiemke);
    }
    public function kiemkenhanvien(Request $req)
    {
        $kiemke = KiemKe::with('hanghoa','kho')->where('ID_Users', $req->nhanvien)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
        return response()->json($kiemke);
    }
    public function kiemkechitietmhkh(Request $req)
    {
        if($req->hanghoa == 1 && $req->kho == 1 && $req->nhanvien == 1){
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten');}))->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
        }elseif ($req->hanghoa != 1 && $req->kho == 1 && $req->nhanvien == 1) {
            $hanghoa = HangHoa::where('MaHH', $req->hanghoa)->first();
            if(empty($hanghoa)){
                $kiemke = "";
            }else{
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten','Username');}))->where('ID_HangHoa', $hanghoa->HangHoaID)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
            }
        }elseif ($req->hanghoa == 1 && $req->kho != 1 && $req->nhanvien == 1) {
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten','Username');}))->where('ID_Kho', $req->kho)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
        }elseif ($req->hanghoa != 1 && $req->kho != 1 && $req->nhanvien == 1) {
            $hanghoa = HangHoa::where('MaHH', $req->hanghoa)->first();
            if(empty($hanghoa)){
                $kiemke = "";
            }else{
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten','Username');}))->where('ID_HangHoa', $hanghoa->HangHoaID)->where('ID_Kho', $req->kho)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
            }
        }elseif ($req->hanghoa != 1 && $req->kho == 1 && $req->nhanvien != 1) {
            if(empty($hanghoa)){
                $kiemke = "";
            }else{
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten','Username');}))->where('ID_HangHoa', $hanghoa->HangHoaID)->where('ID_Users', $req->nhanvien)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
            }
        }elseif ($req->hanghoa == 1 && $req->kho != 1 && $req->nhanvien != 1) {
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten','Username');}))->where('ID_Kho', $req->kho)->where('ID_Users', $req->nhanvien)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
        }elseif ($req->hanghoa == 1 && $req->kho == 1 && $req->nhanvien != 1) {
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten','Username');}))->where('ID_Users', $req->nhanvien)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
        }else {
            $hanghoa = HangHoa::where('MaHH', $req->hanghoa)->first();
            if(empty($hanghoa)){
                $kiemke = "";
            }else{
                $kiemke = KiemKe::with(array('hanghoa','kho','user'=>function($query){$query->select('ID','Ten');}))->where('ID_HangHoa', $hanghoa->HangHoaID)->where('ID_Kho', $req->kho)->where('ID_Users', $req->nhanvien)->whereBetween('NgayKiemKe', array(date('Y-m-d', strtotime($req->tungay)), date('Y-m-d 23:59:59', strtotime($req->denngay))))->get();
            }
        }
        return response()->json($kiemke);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}
}
