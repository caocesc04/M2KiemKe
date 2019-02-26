@extends('layoutall.app')

@section('content')
<div class="container">     
	<div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="form-group col-xs-12">
                    <div class="col-xs-2" style="background-color: #fff !important;border:none">
                        <label class="control-label" for="TuNgay">Từ Ngày</label>
                        <div class="input-group date" style="border: 1px solid #000;">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="TuNgay" name="TuNgay" required="">
                        </div>
                    </div>
                    <div class="col-xs-2" style="background-color: #fff !important;border:none">
                        <label class="control-label" for="DenNgay">Đến Ngày</label>
                        <div class="input-group date" style="border: 1px solid #000;">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="DenNgay" name="DenNgay" required="">
                        </div>
                    </div>
                    <div class="col-xs-2" style="background-color: #fff !important;border:none">
                        <label class="control-label" for="HangHoa">Mã Hàng</label>
                        <input type="text" class="form-control" style="border: 1px solid #000;" name ="HangHoa" id="HangHoa">
                    </div>
                    <div class="col-xs-3" style="background-color: #fff !important;border:none,border: 1px solid #000;">
                        <label class="control-label " for="Kho">Kho Hàng</label>
                        <div>
                        <select class="form-control m-b chosen-select" tabindex="2" name="Kho" id="Kho" style="border: 1px solid #000;">
                            <option value="1"></option>
                            @foreach($kho as $kh)
                            <option value="{{$kh->MaKho}}">
                                {{$kh->TenKho}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="col-xs-3" style="background-color: #fff !important;border:none">
                        <label class="control-label " for="NhanVien">Nhân Viên</label>
                        <div>
                        <select class="form-control m-b chosen-select" tabindex="2" name="NhanVien" id="NhanVien" style="border: 1px solid #000;">
                            <option value="1"></option>
                            @foreach($nhanvien as $nv)
                            <option value="{{$nv->ID}}">
                                {{$nv->Ten}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                </div>
                <div class="form-group col-xs-12">
                    <div class="col-xs-2" style="background-color: #fff !important;border:none">
                    <button type="submit" name="btn" class="btn btn-success kiemkemhkh" data-style="zoom-in"> Lấy dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 style="color: red">Danh sách kiểm kê chi tiết mã hàng, kho hàng</h5>
                    </div>
                    <div class="ibox-content">
                    <div class="table-responsive listkiemke">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Hàng Hóa</th>
                        <th>Mã Nội Bộ</th>
                        <th>Tên Hàng Hóa</th>
                        <th>Số Lượng</th>
                        <th>Nhân Viên</th>
                        <th>Khu Vực</th>
                        <th>Kho</th>
                        <th>Thời Gian</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/reportscript.js') }}"></script>
<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'excel', title: 'FileKiemKe'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
        });
   </script>
@endsection

