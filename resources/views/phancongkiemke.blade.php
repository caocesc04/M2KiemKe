@extends('layoutall.app')

@section('content')
<div class="container">     
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="background-color: ">
                    <h5 class="col-lg-10">Danh sách phân công</h5>
                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal1">
                        <i class="fa fa-paste"></i> Thêm Mới </button>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example css-serial" >
                            <thead>
                                <tr style="font-size: 10px;">
                                      <th style="text-align: center;">STT</th>
                                      <th style="text-align: center;">Tài Khoản Kiểm Kê</th>
                                      <th style="text-align: center;">Kho Hàng</th>
                                      <th style="text-align: center;">Thời gian bắt đầu kiểm kê</th>
                                      <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pckk as $pc)
                                <tr class="bodypckk{{$pc->ID}}">
                                    <td style="text-align: center;"></td>
                                    <td >{{$pc->user->Username}}</td>
                                    <td >{{$pc->kho->TenKho}}</td>
                                    <td >{{date('d-m-Y', strtotime($pc->NgayBatDau))}}</td>
                                    <td class="center" style="display: flex;align-items: center;justify-content: center;">
                                        <button class="btn btn-outline btn-success  dim edit-modal" data-id="{{$pc->ID}}" data-username="{{$pc->ID_Users}}" data-kho="{{$pc->ID_Kho}}" data-ngay="{{date('d-m-Y', strtotime($pc->NgayBatDau))}}" style=" padding: 1px 9px;"><i class="fa fa-paint-brush"></i>Edit</button>
                                        <button class="btn btn-outline btn-danger  dim delete-modal" data-id="{{$pc->ID}}" data-username="{{$pc->user->Username}}" type="submit" style="padding: 1px 9px;"><i class="fa fa-trash"></i>Delete</button>
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
<form method="post" action="{{route('phancongkiemke.store')}}" enctype="multipart/form-data">
{{csrf_field()}}
    <div class="modal inmodal fade" id="myModal1" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 500px;margin: 30px auto;">
            <div class="modal-content"style="border: 3px solid transparent;border-radius: 10px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);border-color: #1ab394;">
                <div class="modal-header"style="padding: 2px 6px;text-align: center;background-color: #1ab394;    border-color: #1ab394;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="color: #ffffff;">Phân công kiểm kê</h4>
                </div>
                <div class="modal-body"style="padding: 1px 30px 1px 30px;">
                    <div class="row show-grid">
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Người kiểm kê</p></b>
                            <select class="form-control m-b" name="NguoiKiemKe" style="border-radius: 10px;">
                                @foreach($user as $us)
                                <option value="{{$us->ID}}">{{$us->Ten}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Kho hàng</p> </b>
                            <select class="form-control m-b" name="Kho" style="border-radius: 10px;">
                                @foreach($kho as $kh)
                                <option value="{{$kh->MaKho}}">{{$kh->TenKho}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Thời gian bắt đầu kiểm kê</p> </b>
                            <div class="input-group date" style="border: 1px solid #000;">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="ThoiGianKiemKe" name="ThoiGianKiemKe">
                            </div>
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
                    <h4 class="modal-title" style="color: #ffffff;">Edit</h4>
                </div>
                <div class="modal-body" style="padding: 1px 30px 1px 30px;">
                    <form class="form-horizontal" role="form">
                    <div class="row show-grid">
                        <input type="hidden" class="form-control" id="fid" name="fid" disabled>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Người kiểm kê</p></b>
                            <select class="form-control m-b" name="NguoiKiemKe" id="NguoiKiemKe" style="border-radius: 10px;">
                                @foreach($user as $us)
                                <option value="{{$us->ID}}">{{$us->Ten}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Cửa hàng</p> </b>
                            <select class="form-control m-b" name="Kho" id="Kho" style="border-radius: 10px;">
                                @foreach($kho as $kh)
                                <option value="{{$kh->MaKho}}">
                                    {{$kh->TenKho}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12" style="background-color: #fff !important;border:none">
                            <b><p>Thời gian bắt đầu kiểm kê</p> </b>
                            <div class="input-group date" style="border: 1px solid #000;">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="ThoiGianBatDau" name="ThoiGianBatDau">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    Bạn có chắc muốn xóa phân công của <span class="dname" style="color: red">
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
<script src="{{ asset('js/ajaxscript.js') }}"></script>
@endsection

