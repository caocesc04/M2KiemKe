@extends('layoutall.app')

@section('content')
<div class="container">     
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="background-color: ">
                    <h5 class="col-lg-10">Danh sách nhân viên</h5>
                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal1">
                        <i class="fa fa-paste"></i> Thêm Mới </button>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example css-serial" >
                            <thead>
                                <tr style="font-size: 10px;">
                                      <th style="text-align: center;">STT</th>
                                      <th style="text-align: center;">Tài Khoản</th>
                                      <th style="text-align: center;">Mật Khẩu</th>
                                      <th style="text-align: center;">Tên Nhân Viên</th>
                                      <th style="text-align: center;">Biệt Danh</th>
                                      <th style="text-align: center;">Trạng Thái</th>
                                      <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nhanvien as $nv)
                                <tr class="nv{{$nv->ID}}">
                                    <td style="text-align: center;"></td>
                                    <td >{{$nv->Username}}</td>
                                    <td >{{$nv->Password}}</td>
                                    <td >{{$nv->Ten}}</td>
                                    <td >{{$nv->BietDanh}}</td>
                                    @if($nv->Status == 1)
                                    <td style="text-align: center; color: green">Mở</td>
                                    @else
                                    <td style="text-align: center; color: red">Đóng</td>
                                    @endif
                                    <td class="center" style="display: flex;align-items: center;justify-content: center;">
                                        <button class="btn btn-outline btn-info  dim change-modal" data-id="{{$nv->ID}}" type="submit" style=" padding: 1px 9px;"><i class="fa fa-refresh"></i>Change</button>
										<button class="btn btn-outline btn-success  dim edit-modal" data-id="{{$nv->ID}}" data-username="{{$nv->Username}}" data-password="{{$nv->Password}}" data-ten="{{$nv->Ten}}" data-bietdanh="{{$nv->BietDanh}}"  style=" padding: 1px 9px;"><i class="fa fa-paint-brush"></i>Edit</button>
										<button class="btn btn-outline btn-danger  dim delete-modal" data-id="{{$nv->ID}}" data-username="{{$nv->Username}}" type="submit" style=" padding: 1px 9px;"><i class="fa fa-trash"></i>Delete</button>
									</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="{{route('loginss.store')}}" enctype="multipart/form-data">
{{csrf_field()}}
    <div class="modal inmodal fade" id="myModal1" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 500px;margin: 30px auto;">
            <div class="modal-content"style="border: 3px solid transparent;border-radius: 10px;    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);border-color: #1ab394;">
                <div class="modal-header"style="padding: 2px 6px;text-align: center;background-color: #1ab394;    border-color: #1ab394;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"style="color: #ffffff;">Thêm tài khoản nhân viên</h4>
                </div>
                <div class="modal-body"style="padding: 1px 30px 1px 30px;">
                    <div class="row show-grid">
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Tên Đăng Nhập</p></b>
                             <input style="border-radius: 5px; border: 1px solid #000;" type="text" class="form-control" name="username" required="">
                        </div> 
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Mật Khẩu</p> </b>
                            <input style="border-radius: 5px; border: 1px solid #000;" type="password" class="form-control" name="password" required="">
                        </div>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Tên người dùng</p></b>
                             <input style="border-radius: 5px; border: 1px solid #000;" type="text" class="form-control" name="tennhanvien" required="">
                        </div>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Biệt Danh</p></b>
                             <input style="border-radius: 5px; border: 1px solid #000;" type="text" class="form-control" name="bietdanh">
                        </div>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <label class="control-label" for="loaitaikhoan">Loại Tài Khoản</label>
                            <select name="loaitaikhoan" id="loaitaikhoan" class="form-control">
                                <option value="0">Nhân viên</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-info" data-dismiss="modal"style="    margin-bottom: 0px;">Đóng</button>
                    <button type="submit" class="btn btn-success" data-style="zoom-in" > Lưu </button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 500px;margin: 30px auto;">
            <div class="modal-content"style="border: 3px solid transparent;border-radius: 10px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);border-color: #1ab394;">
                <div class="modal-header"style="padding: 2px 6px;text-align: center;background-color: #1ab394;    border-color: #1ab394;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="color: #ffffff;">Phân công kiểm kê</h4>
                </div>
                <div class="modal-body"style="padding: 1px 30px 1px 30px;">
                <form class="form-horizontal" role="form">
                    <div class="row show-grid">
                    <input type="hidden" class="form-control" id="fid" name="fid" disabled>
                    <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Tên Đăng Nhập</p></b>
                             <input style="border-radius: 5px; border: 1px solid #000;" type="text" class="form-control" name="username" id="username" required="">
                        </div> 
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Mật Khẩu</p> </b>
                            <input style="border-radius: 5px; border: 1px solid #000;" type="text" class="form-control" name="password" id="password" required="">
                        </div>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Tên người dùng</p></b>
                             <input style="border-radius: 5px; border: 1px solid #000;" type="text" class="form-control" name="tennhanvien" id="tennhanvien" required="">
                        </div>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Biệt Danh</p></b>
                             <input style="border-radius: 5px; border: 1px solid #000;" type="text" class="form-control" name="bietdanh" id="bietdanh">
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    Xóa tài khoản <span class="dname" style="color: red">
                    </span> ? <span class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
 <script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/userscript.js') }}"></script>
@endsection

