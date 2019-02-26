$(document).ready(function() {
    var date = function(dateObject) {
        var d = new Date(dateObject.substring(0, 10));
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = year + "-" + month + "-" + day;
        return date;
    };
    $.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
    $(document).on('click', '.kiemkehethong', function() {
        $.ajax({
            type: 'post',
            url: '/kiemkehethong',
            data: {
                'tungay': $("#TuNgay").val(),
                'denngay': $("#DenNgay").val()
            },
            success: function(resp) {
                var headers = '<table class="table table-striped table-bordered table-hover dataTables-example css-serial" ><thead><tr><th>STT</th><th>Mã Sản Phẩm</th><th>Tên Sản Phẩm</th><th>Số Lượng</th></tr></thead><tbody>';
                var trHTML = '';
                $.each(resp, function (i, userData) {
                    trHTML +=
                        '<tr><td></td><td>'
                        + userData.hanghoa.MaHH
                        + '</td><td>'
                        + userData.hanghoa.TenHH
                        + '</td><td>'
                        + userData.SoLuong 
                        + '</td></tr>';
                });
                $('.listkiemke').empty().append(headers + trHTML);
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
            }
        });
    });
    $(document).on('click', '.kiemkecuahang', function() {
        $.ajax({
            type: 'post',
            url: '/kiemkecuahang',
            data: {
                'tungay': $("#TuNgay").val(),
                'denngay': $("#DenNgay").val(),
                'kho': $("#Kho").val()
            },
            success: function(resp) {
                var headers = '<table class="table table-striped table-bordered table-hover dataTables-example css-serial"><thead><tr><th>STT</th><th>Mã Hàng Hóa</th><th>Mã Nội Bộ</th><th>Tên Hàng Hóa</th><th>Số Lượng</th></tr></thead><tbody>';
                var trHTML = '';
                total = 0;
                $.each(resp, function (i, userData) {
                    trHTML +=
                        '<tr><td></td><td>'
                        + userData.hanghoa.MaHH
                        + '</td><td>'
                        + userData.hanghoa.MaGoiNho
                        + '</td><td>'
                        + userData.hanghoa.TenHH
                        + '</td><td>'
                        + userData.SoLuong
                        + '</td></tr>';
                    total += userData.SoLuong;
                });
                var footer = '<tfoot><tr><th colspan="5" style="color:red;text-align: center;font-weight: bold">Total: '+total+'</th></tr></tfoot>';
                $('.listkiemke').empty().append(headers+trHTML+footer);
                $('.dataTables-example').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'excel', title: 'FileKiemKe',
                        exportOptions: {
                            orthogonal: 'sort'
                        },
                        customizeData: function ( data ) {
                            for (var i=0; i<data.body.length; i++){
                                for (var j=0; j<data.body[i].length; j++ ){
                                    data.body[i][j] = '\u200C' + data.body[i][j];
                                }
                            }
                        }},
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
        	}
		});
	});
	$(document).on('click', '.kiemkenhanvien', function() {
        console.log($("#NhanVien").val());
        $.ajax({
            type: 'post',
            url: '/kiemkenhanvien',
            data: {
                'tungay': $("#TuNgay").val(),
                'denngay': $("#DenNgay").val(),
                'nhanvien': $("#NhanVien").val()
            },
            success: function(resp) {
            	console.log(resp);
                var headers = '<table class="table table-striped table-bordered table-hover dataTables-example css-serial" ><thead><tr><th>STT</th><th>Mã Sản Phẩm</th><th>Tên Sản Phẩm</th><th>Số Lượng</th><th>Ngày Kiểm Kê</th><th>Kho Hàng</th><th>Khu Vực</th></tr></thead><tbody>';
                var trHTML = '';
                $.each(resp, function (i, userData) {
                    trHTML +=
                        '<tr><td></td><td>'
                        + userData.hanghoa.MaHH
                        + '</td><td>'
                        + userData.hanghoa.TenHH
                        + '</td><td>'
                        + userData.SoLuong 
                        + '</td><td>'
                        + userData.NgayKiemKe 
						+ '</td><td>'
                        + userData.kho.TenKho 
                        + '</td><td>'
                        + userData.TenKeHang
                        + '</td></tr>';
                });
                $('.listkiemke').empty().append(headers+trHTML);
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
        	}
		});
	});
    $(document).on('click', '.kiemkemhkh', function() {
        if($("#HangHoa").val().length == 0){
            hanghoa = 1;
        }else{
            hanghoa = $("#HangHoa").val();
        }
        console.log(hanghoa);
        $.ajax({
            type: 'post',
            url: '/kiemkemhkh',
            data: {
                'tungay': $("#TuNgay").val(),
                'denngay': $("#DenNgay").val(),
                'hanghoa': hanghoa,
                'kho': $("#Kho").val(),
                'nhanvien': $("#NhanVien").val()
            },
            success: function(resp) {
                var headers = '<table class="table table-striped table-bordered table-hover dataTables-example css-serial" ><thead><tr><th>STT</th><th>Mã Hàng Hóa</th><th>Mã Nội Bộ</th><th>Tên Hàng Hóa</th><th>Số Lượng</th><th>Nhân Viên</th><th>Khu Vực</th><th>Kho</th><th>Thời Gian</th></tr></thead><tbody>';
                var trHTML = '';
                total = 0;
                $.each(resp, function (i, userData) {
                    trHTML +=
                        '<tr><td></td><td>'
                        + userData.hanghoa.MaHH
                        + '</td><td>'
                        + userData.hanghoa.MaGoiNho
                        + '</td><td>'
                        + userData.hanghoa.TenHH
                        + '</td><td>'
                        + userData.SoLuong
                        + '</td><td>'
                        + userData.user.Ten
                        + '</td><td>'
                        + userData.TenKeHang 
                        + '</td><td>'
                        + userData.kho.TenKho
                        + '</td><td>'
                        + userData.NgayKiemKe
                        + '</td></tr>';
                    total += userData.SoLuong;
                });
                var footer = '</tbody><tfoot><tr><th>Total:</th><th></th><th></th><th></th><th style="color:red">'+total+'</th><th></th><th></th><th></th><th></th></tr></tfoot>';
                $('.listkiemke').empty().append(headers+trHTML+footer);
                $('.dataTables-example').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'excel', title: 'FileKiemKe',
                        exportOptions: {
                            orthogonal: 'sort'
                        },
                        customizeData: function ( data ) {
                            for (var i=0; i<data.body.length; i++){
                                for (var j=0; j<data.body[i].length; j++ ){
                                    data.body[i][j] = '\u200C' + data.body[i][j];
                                }
                            }
                        } 
                        },
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
            }
        });
    });
})
