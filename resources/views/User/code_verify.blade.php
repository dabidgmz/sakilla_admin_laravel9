<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Code</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="icon" href="{{ asset('dist/img/CinemaStudio.png') }}" type="image/x-icon">
    
    <style>
        .code-input {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .code-input input {
            width: 50px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            border: 2px solid #007bff;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s;
        }
        .code-input input:focus {
            border-color: #0056b3;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
    <b>Cinema</b>Studio</a>
    </div>
    <!-- Card -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Enter the verification code</p>
            
            <form id="verification-form" method="POST">
                @csrf
                <div class="code-input">
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                </div>
                
                <div class="form-group text-center mt-3">
                    <div class="h-captcha" data-sitekey="bb4246a6-ef30-468e-8172-9b88f49ac424"></div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" disabled>Verify</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</body>
</html>
