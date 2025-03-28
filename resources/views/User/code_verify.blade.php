<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Code</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="icon" href="{{ asset('dist/img/CinemaStudio.png') }}" type="image/x-icon">

    <style>
        body {
            background: #000;
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            width: 400px;
        }

        .login-logo b {
            color: #fff;
            font-size: 28px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-body {
            padding: 30px;
            text-align: center;
        }

        .code-input {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .code-input input {
            width: 50px;
            height: 50px;
            font-size: 22px;
            text-align: center;
            border: 2px solid #6a11cb;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
            font-weight: bold;
        }

        .code-input input:focus {
            border-color: #ff7eb3;
            box-shadow: 0 0 10px rgba(255, 126, 179, 0.5);
        }

        .btn-primary {
            background-color: #6a11cb;
            border: none;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #ff7eb3;
        }

        .disabled {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</head>
<body class="hold-transition d-flex align-items-center justify-content-center min-vh-100">
<div class="login-box">
    <div class="login-logo">
        <b>Cinema</b>Studio
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <h5 class="mb-4">Enter the Verification Code</h5>

            <form id="verification-form" method="POST" action="{{ route('verify-code') }}">
                @csrf
                <input type="hidden" name="type" value="login">

                <div class="code-input">
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                    <input type="text" maxlength="1" required />
                </div>

                <input type="hidden" name="temp_code" id="temp_code">
                <button type="submit" class="btn btn-primary btn-block disabled" disabled>Verify</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".code-input input");
    const form = document.getElementById('verification-form');
    const submitButton = form.querySelector("button[type='submit']");
    const hiddenInput = document.getElementById("temp_code");

    function updateButtonState() {
        let allFilled = [...inputs].every(input => input.value.length === 1);
        submitButton.disabled = !allFilled;
        submitButton.classList.toggle("disabled", !allFilled);
    }

    inputs.forEach((input, index) => {
        input.addEventListener("input", function () {
            if (this.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateButtonState();
        });

        input.addEventListener("keydown", function (event) {
            if (event.key === "Backspace" && this.value === "" && index > 0) {
                inputs[index - 1].focus();
            }
            updateButtonState();
        });
    });

    form.addEventListener("submit", function (event) {
        hiddenInput.value = [...inputs].map(input => input.value).join("");
    });

    updateButtonState();
});
</script>
</body>
</html>
