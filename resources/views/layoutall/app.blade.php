<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>M2 Fashion</title>

    <link href="inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="inspinia/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="inspinia/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="inspinia/css/animate.css" rel="stylesheet">
    <link href="inspinia/css/style.css" rel="stylesheet">
    <link href="inspinia/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href="inspinia/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
    <link href="inspinia/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="inspinia/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/inspinia/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Quản lý kiểm kê hàng hóa</strong>
                             </span></span> </a>
                    </div>
                </li>
                <li>
                    <a href="/adduser"><i class="fa fa-navicon"></i> <span class="nav-label">Quản Lý Tài Khoản</span></span></a>
                </li>
                <li>
                    <a href="/phancongkiemke"><i class="fa fa-cog"></i> <span class="nav-label">Phân Công Kiểm Kê</span></span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Kiểm Kê</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li ><a href="/kiemkecuahang">Tổng Hợp</a></li>
                        <li ><a href="/chitietmhkh">Chi Tiết</a></li>  
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a href="/">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>
        </nav>
        </div>
        <main class="py-4">
            @if (Session::has('error'))
              <div class="alert alert-danger">
                    <p>{{ Session::get('error') }}</p>
              </div><br />
              @endif
              @if (Session::has('success'))
              <div class="alert alert-success">
                  <p>{{ Session::get('success') }}</p>
              </div><br />
            @endif
            @yield('content')
        </main>
    </div>
</body>
    <script src="inspinia/js/jquery-3.1.1.min.js"></script>
    <script src="inspinia/js/bootstrap.min.js"></script>
    <script src="inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="inspinia/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="inspinia/js/inspinia.js"></script>
    <script src="inspinia/js/plugins/pace/pace.min.js"></script>

    <script src="inspinia/js/plugins/jqGrid/i18n/grid.locale-en.js"></script>
    <script src="inspinia/js/plugins/jqGrid/jquery.jqGrid.min.js"></script>

    <!-- Steps -->
    <script src="inspinia/js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="inspinia/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="inspinia/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="inspinia/js/plugins/dataTables/datatables.min.js"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>
    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }
                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
            $('#ThoiGianKiemKe').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format:"dd-mm-yyyy"
            });
            $('#ThoiGianBatDau').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format:"dd-mm-yyyy"
            });
            $('#TuNgay').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format:"dd-mm-yyyy",
                setDate: new Date(),
            }).datepicker("setDate", new Date());
            $('#DenNgay').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format:"dd-mm-yyyy"
            }).datepicker("setDate", new Date());
       });
    </script>
</html>
