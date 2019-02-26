<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kho;
use App\PhanCongKiemKe;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PhanCongKiemKeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('Permission', 2)->get();
        $kho = Kho::get();
        $pckk = PhanCongKiemKe::with('user')->where('Status', 1)->get();
        return view('phancongkiemke', compact('user','kho','pckk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pckk = new PhanCongKiemKe;
        $pckk->ID_Kho = $request->Kho;
        $pckk->ID_Users = $request->NguoiKiemKe;
        $pckk->NgayBatDau = date('Y-m-d', strtotime($request->ThoiGianKiemKe));
        $pckk->status = '1';
        $pckk->save();
        return Redirect::back()->with('success','Nhân viên đã được phân công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function editpckk(Request $req)
    {
        // $user = User::select('ID')->where('Username', $req->nguoikiemke)->first();
        // $cuahang = CuaHang::select('MaCH')->where('TenCH', $req->cuahang)->first();
        $pckk = PhanCongKiemKe::select('ID','ID_Users','ID_Kho','NgayBatDau','Status')->find($req->id);
        $pckk->ID_Users = $req->nguoikiemke;
        $pckk->ID_Kho = $req->kho;
        $pckk->NgayBatDau = date('Y-m-d', strtotime($req->thoigianbatdau));
        $pckk->Status = '1';
        $pckk->save();
        $pckk = PhanCongKiemKe::with(array('kho','user'=>function($query){$query->select('ID','Username');}))->select('ID','ID_Users','ID_Kho','NgayBatDau','Status')->find($req->id);
        return response()->json($pckk);
    }
    public function deletepckk(Request $req) {
        PhanCongKiemKe::find ( $req->id )->delete ();
        return response ()->json ();
    }
}
