<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\KiemKe;
use Illuminate\Http\Request;
use Redirect;


class LoginsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //function encode
    public function login(Request $req){
        $user = User::where('Username', $req->Username)->where('Password', $req->Password)->where('Permission', '!=', 2)->pluck('Ten')->first();
        $nhanvien  = User::where('Permission','2')->where('Status','1')->get();
        if($user != null){
            return redirect()->away('/adduser');
        }else{
            return Redirect::back()->with('successMsg','Mời bạn đăng nhập lại!');
        }
    }

    public function index()
    {
        $nhanvien  = User::where('Permission','2')->get();
        return view('adduser', compact('nhanvien','user'));
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
        if($request->loaitaikhoan == 0){
        $usr = new User;
        $usr->Username = $request->username;
        $usr->Password = $request->password;
        $usr->Ten = (mb_detect_encoding($request->tennhanvien, mb_detect_order(), true) === 'UTF-8') 
            ? $request->tennhanvien : iconv('iso-8859-1', 'utf-8', $request->tennhanvien);
        $usr->BietDanh = (mb_detect_encoding($request->bietdanh, mb_detect_order(), true) === 'UTF-8') 
            ? $request->bietdanh : iconv('iso-8859-1', 'utf-8', $request->bietdanh);
        $usr->Permission = '2';
        $usr->Status = '1';
        $usr->save();
        }
        if($request->loaitaikhoan == 1){
        $usr = new User;
        $usr->Username = $request->username;
        $usr->Password = $request->password;
        $usr->Ten = (mb_detect_encoding($request->tennhanvien, mb_detect_order(), true) === 'UTF-8') 
            ? $request->tennhanvien : iconv('iso-8859-1', 'utf-8', $request->tennhanvien);
        $usr->BietDanh = (mb_detect_encoding($request->bietdanh, mb_detect_order(), true) === 'UTF-8') 
            ? $request->bietdanh : iconv('iso-8859-1', 'utf-8', $request->bietdanh);
        $usr->Permission = '1';
        $usr->Status = '1';
        $usr->save();
        }
        return Redirect::back()->with('success','Đăng kí thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
