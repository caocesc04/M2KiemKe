<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M2 Fashion</title>
    <link href="inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="inspinia/css/animate.css" rel="stylesheet">
    <link href="inspinia/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">

    <div class="middle-box text-center animated fadeInDown">
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
            <div>
                <h1 class="logo-name"><h1 class="logo-name"><img alt="image" src="/inspinia/img/m2.jpg" /></h1></h1>
            </div>
            <h3 style="font-size: 32px; color: red; font-weight: bold">Đăng kí tài khoản Admin</h3>
            <form style="margin-top: 20px" class="form-horizontal" method="post" action="{{route('registers.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tên Tài Khoản:</label>
                    <div class="col-sm-8"><input type="text" class="form-control" name="username" required=""></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Mật Khẩu:</label>
                     <div class="col-sm-8"><input type="password" class="form-control" name="password" required=""></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Xác Nhận Mật Khẩu:</label>
                     <div class="col-sm-8"><input type="password" class="form-control" name="repassword" required=""></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tên Hiển Thị:</label>
                     <div class="col-sm-8"><input type="text" class="form-control" name="Ten" required="Mời nhập Tên của bạn"></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
                <a href="/" class="btn btn-success block full-width m-b">Login</a>
            </form>
    </div>

    <!-- Mainly scripts -->
    <script src="inspinia/js/jquery-3.1.1.min.js"></script>
    <script src="inspinia/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="inspinia/js/plugins/iCheck/icheck.min.js"></script>
</body>

</html>
