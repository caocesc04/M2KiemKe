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
        var date = day + "-" + month + "-" + year;
        return date;
    };
  $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text("Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#username').val($(this).data('username'));
        $('#password').val($(this).data('password'));
        $('#tennhanvien').val($(this).data('ten'));
        $('#bietdanh').val($(this).data('bietdanh'));
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text("Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('username'));
        $('#myModal').modal('show');
    });
    $(document).on('click', '.change-modal', function() {
        $.ajax({
            type: 'post',
            url: '/changestatus',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $(this).data('id')
            },
            success: function(data) {
                console.log(data);
                var result1 = "<tr class='nv"+data.ID+"'><td style='text-align: center;'></td><td >"+ data.Username +"</td><td >"+data.Password+"</td><td >"+data.Ten+"</td><td >"+data.BietDanh+"</td><td style='text-align: center; color: green'>Mở</td>"+
                    "<td class='center' style='display: flex;align-items: center;justify-content: center;'><button class='btn btn-outline btn-info  dim change-modal' data-id=" +data.ID+" type='submit' style='padding: 1px 9px;'><i class='fa fa-refresh'></i>Change</button><button class='btn btn-outline btn-success  dim edit-modal' data-id="+ data.ID+" data-username="+ data.Username+" data-password="+data.Password+" data-ten="+data.Ten+" data-bietdanh="+data.BietDanh+" style='padding: 1px 9px;'><i class='fa fa-paint-brush'></i>Edit</button> <button class='btn btn-outline btn-danger  dim delete-modal' data-id="+data.ID+" data-username="+data.Username+" type='submit' style= 'padding: 1px 9px;'><i class='fa fa-trash'></i>Delete</button></td></tr>";
                var result0 = "<tr class='nv"+data.ID+"'><td style='text-align: center;'></td><td >"+ data.Username +"</td><td >"+data.Password+"</td><td >"+data.Ten+"</td><td >"+data.BietDanh+"</td><td style='text-align: center; color: red'>Đóng</td>"+
                    "<td class='center' style='display: flex;align-items: center;justify-content: center;'><button class='btn btn-outline btn-info  dim change-modal' data-id=" +data.ID+" type='submit' style='padding: 1px 9px;'><i class='fa fa-refresh'></i>Change</button><button class='btn btn-outline btn-success  dim edit-modal' data-id="+ data.ID+" data-username="+ data.Username+" data-password="+data.Password+" data-ten="+data.Ten+" data-bietdanh="+data.BietDanh+" style='padding: 1px 9px;'><i class='fa fa-paint-brush'></i>Edit</button> <button class='btn btn-outline btn-danger  dim delete-modal' data-id="+data.ID+" data-username="+data.Username+" type='submit' style= 'padding: 1px 9px;'><i class='fa fa-trash'></i>Delete</button></td></tr>";
                if (data.Status == 1) {
                    $('.nv'+data.ID).replaceWith(result1);
                } else {
                    $('.nv'+data.ID).replaceWith(result0);
                }
            }
        });
    });
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            method: 'POST',
            url: '/editnhanvien',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'username': $('#username').val(),
                'password': $('#password').val(),
                'tennhanvien': $('#tennhanvien').val(),
                'bietdanh': $('#bietdanh').val()
            },
            success: function(data) {
                console.log(data);
                var result1 = "<tr class='nv"+data.ID+"'><td style='text-align: center;'></td><td >"+ data.Username +"</td><td >"+data.Password+"</td><td >"+data.Ten+"</td><td >"+data.BietDanh+"</td><td style='text-align: center; color: green'>Mở</td>"+
                    "<td class='center' style='display: flex;align-items: center;justify-content: center;'><button class='btn btn-outline btn-info  dim change-modal' data-id=" +data.ID+" type='submit' style='padding: 1px 9px;'><i class='fa fa-refresh'></i>Change</button><button class='btn btn-outline btn-success  dim edit-modal' data-id="+ data.ID+" data-username="+ data.Username+" data-password="+data.Password+" data-ten="+data.Ten+" data-bietdanh="+data.BietDanh+" style='padding: 1px 9px;'><i class='fa fa-paint-brush'></i>Edit</button> <button class='btn btn-outline btn-danger  dim delete-modal' data-id="+data.ID+" data-username="+data.Username+" type='submit' style= 'padding: 1px 9px;'><i class='fa fa-trash'></i>Delete</button></td></tr>";
                var result0 = "<tr class='nv"+data.ID+"'><td style='text-align: center;'></td><td >"+ data.Username +"</td><td >"+data.Password+"</td><td >"+data.Ten+"</td><td >"+data.BietDanh+"</td><td style='text-align: center; color: red'>Đóng</td>"+
                    "<td class='center' style='display: flex;align-items: center;justify-content: center;'><button class='btn btn-outline btn-info  dim change-modal' data-id=" +data.ID+" type='submit' style='padding: 1px 9px;'><i class='fa fa-refresh'></i>Change</button><button class='btn btn-outline btn-success  dim edit-modal' data-id="+ data.ID+" data-username="+ data.Username+" data-password="+data.Password+" data-ten="+data.Ten+" data-bietdanh="+data.BietDanh+" style='padding: 1px 9px;'><i class='fa fa-paint-brush'></i>Edit</button> <button class='btn btn-outline btn-danger  dim delete-modal' data-id="+data.ID+" data-username="+data.Username+" type='submit' style= 'padding: 1px 9px;'><i class='fa fa-trash'></i>Delete</button></td></tr>";
                if (data.Status == 1) {
                    $('.nv'+data.ID).replaceWith(result1);
                } else {
                    $('.nv'+data.ID).replaceWith(result0);
                }
            }
        });
    });
    $(document).on('click', '.kiemkehethong', function() {
        console.log($("#TuNgay").val());
        $.ajax({
            type: 'post',
            url: '/kiemkehethong',
            data: {
                '_token': $('input[name=_token]').val(),
                'tungay': '$("#TuNgay").val()',
                'denngay': '$("#DenNgay").val()'
            },
            success: function(data) {
                console.log(data);
            }
        });
    });

    // $("#add").click(function() {

    //     $.ajax({
    //         type: 'post',
    //         url: '/addItem',
    //         data: {
    //             '_token': $('input[name=_token]').val(),
    //             'name': $('input[name=name]').val()
    //         },
    //         success: function(data) {
    //             if ((data.errors)){
    //               $('.error').removeClass('hidden');
    //                 $('.error').text(data.errors.name);
    //             }
    //             else {
    //                 $('.error').addClass('hidden');
    //                 $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
    //             }
    //         },

    //     });
    //     $('#name').val('');
    // });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deletenhanvien',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.nv' + $('.did').text()).remove();
            }
        });
    });
});
