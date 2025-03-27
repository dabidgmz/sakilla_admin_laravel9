<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="icon" href="{{ asset('dist/img/CinemaStudio.png') }}" type="image/x-icon">
    <style>
      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background: rgb(27, 25, 25);
        top: 0;
        bottom: 0;
      }
      .logo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    } 
    .btn {
        color: white;
        padding: 5px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease-in-out;
    }
    </style>
</head>
  <!--hold-transition login-page-->
  <body class="">
  <div class="header">
      <a href="{{ route('home') }}">
          <img src="dist/img/CinemaStudio.png" alt="Cinema Studio" class="logo">
      </a>
  </div>
  <div class="hold-transition login-page">  
  <div class="login-box">
    <div class="login-logo text-center text-white">
      <b>Cinema</b>Studio</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{route ('User.login')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="{{ route('google.login') }}" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->
        <p class="mb-0">
          <a href="{{ route('User.register') }}" class="text-center">Register a new membership</a>
        </p>

        <p class="mb-0">
          <a href="{{ route('User.forgot_password') }}" class="text-center">I forgot my password</a>
        </p>
        <div class="h-captcha" data-sitekey="bb4246a6-ef30-468e-8172-9b88f49ac424"></div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</body>
</html>
