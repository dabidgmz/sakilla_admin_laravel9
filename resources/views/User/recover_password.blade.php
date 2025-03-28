<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recover Password</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="icon" href="{{ asset('dist/img/CinemaStudio.png') }}" type="image/x-icon">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
  <div class="card-header text-center">
  <b>Cinema</b>Studio</a>
  </div>
  <div class="card-body">
    <p class="login-box-msg">You are only one step away from your new password, recover your password now.</p>
    <form action="{{ route('User.reset_password') }}" method="post">
    @csrf
    <div class="input-group mb-3">
      <input type="email" name="email" class="form-control" placeholder="Email" required>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" name="password" class="form-control" placeholder="New Password" required>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
      </div>
    </div>
    </form>

    <p class="mt-3 mb-1">
    <a href="{{route('User.login')}}">Login</a>
    </p>
  </div>
  <!-- /.login-card-body -->
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
