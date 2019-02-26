<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="inspinia/css/animate.css" rel="stylesheet">
    <link href="inspinia/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    @if (Session::has('successMsg'))
        <div class="alert alert-danger">
            <p>{{ Session::get('successMsg') }}</p>
        </div><br />
    @endif
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name"><img alt="image" src="/inspinia/img/m2.jpg" /></h1>
            </div>
             <form action="{{url('home')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" name ="Username" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name ="Password" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="inspinia/js/jquery-3.1.1.min.js"></script>
    <script src="inspinia/js/bootstrap.min.js"></script>

</body>

</html>
