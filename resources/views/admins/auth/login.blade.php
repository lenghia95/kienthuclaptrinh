<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendors/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('vendors/plugins/iCheck/square/blue.css') }}">


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">
<?php $config = new App\Models\Config;?>
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('admin') }}">{{ $config->getByKey('sitename_part1') }} </b>{{ $config->getByKey('sitename_part2') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        @if(session('failed'))
        <p class="text-center" style="color: red;">{{ session('failed') }}</p>
        @endif
        <form action="{{ route('login') }}" method="post" id="valiLogin">
            @csrf

            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <label style="display: inline" id="email-error" class="error" for="email"></label>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <label style="display: inline" id="password-error" class="error" for="password"></label>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign in"/>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
        <!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('vendors/plugins/iCheck/icheck.min.js') }}"></script>
<!-- jQuery Validate -->
<script src="{{ asset('vendors/plugins/jquery-validation/jquery.validate.min.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    $(document).ready(function(){
        $('#valiLogin').validate();
    });
</script>
</body>
</html>
