@extends('layoutall.app')

@section('content')
<div class="container">     
	<div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-4" style="background-color: #fff !important;border:none">
                        <label class="control-label" for="TuNgay">Từ Ngày</label>
                        <div class="input-group date" style="border: 1px solid #000;">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="TuNgay" name="TuNgay" required="">
                        </div>
                    </div>
                    <div class="col-xs-4" style="background-color: #fff !important;border:none">
                        <label class="control-label" for="DenNgay">Đến Ngày</label>
                        <div class="input-group date" style="border: 1px solid #000;">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="DenNgay" name="DenNgay" required="">
                        </div>
                    </div>
                    <div class="col-xs-4" style="background-color: #fff !important;border:none">
                        <label class="control-label" for="NhanVien">Nhân Viên</label>
                        <select class="form-control m-b" name="NhanVien" id="NhanVien" style="border-radius: 10px;">
                            @foreach($user as $us)
                            <option value="{{$us->ID}}">
                                {{$us->Ten}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-3">
                        <button type="submit" name="btn" class="btn btn-success kiemkenhanvien" data-style="zoom-in" style=""> Lấy dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 style="color: red">Danh sách kiểm kê theo nhân viên</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive listkiemke">
                    <table class="table table-striped table-bordered table-hover dataTables-example css-serial" >
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Ngày Kiểm Kê</th>
                        <th>Kho Hàng</th>
                        <th>Khu Vực</th>
                    </tr>
                    </thead>
                    <tbody >
                        <tr>
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
                    {extend: 'excel', title: 'ExampleFile'},
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