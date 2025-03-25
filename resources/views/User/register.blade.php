<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
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
<body class="">
  <div class="header">
      <a href="{{ route('home') }}">
          <img src="dist/img/CinemaStudio.png" alt="Cinema Studio" class="logo">
      </a>
      <a href="{{ route('User.login') }}" class="btn">Login</a>
  </div>
  <div class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo text-center text-white">
    <b>Cinema</b>Studio</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="../../index.html" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="second_name" name="second_name" placeholder="Second Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control"  id="email" name="email"  placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password'" name="password'" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google mr-2"></i>
            Sign up using Google
          </a>
        </div>

        <a href="{{ route('User.login') }}"" class="text-center">I already have a membership</a>
        <div class="h-captcha" data-sitekey="your_site_key"></div>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</body>
</html>
