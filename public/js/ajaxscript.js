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
        $('#NguoiKiemKe').val($(this).data('username'));
        $('#Kho').val($(this).data('kho'));
        $('#ThoiGianBatDau').val($(this).data('ngay'));
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
    $('.modal-footer').on('click', '.edit', function() {
        console.log($('#Kho').val());
        $.ajax({
            method: 'POST',
            url: '/editphancong',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'nguoikiemke': $('#NguoiKiemKe').val(),
                'kho': $('#Kho').val(),
                'thoigianbatdau': $('#ThoiGianBatDau').val()
            },
            success: function(data) {
                console.log(data);
                $('.bodypckk'+data.ID).replaceWith("<tr class='bodypckk"+data.ID+"'><td style='text-align: center;'></td><td >"+ data.user.Username +"</td><td >"+data.kho.TenKho+"</td><td >"+date(data.NgayBatDau)+"</td>"
                    +"<td style='text-align: center;'><button class='btn btn-outline btn-success  dim edit-modal' data-id='"+ data.ID+"' data-username='"+ data.ID_Users+"' data-kho='"+data.ID_Kho+"'data-ngay="+data.NgayBatDau+"' style='padding: 1px 9px;'><i class='fa fa-paint-brush'></i>Edit</button> <button class='btn btn-outline btn-danger  dim delete-modal' data-id='"+data.ID+"' data-username='"+data.user.Username+"' type='submit' style= 'padding: 1px 9px;'><i class='fa fa-trash'></i>Delete</button></td></tr>");
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
            url: '/deletephancong',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.bodypckk' + $('.did').text()).remove();
            }
        });
    });
});
