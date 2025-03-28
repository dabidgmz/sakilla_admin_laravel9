<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Auth Mail</title>
    
    <!-- AdminLTE Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <style>
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #f4f6f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            padding: 10px;
            background: #007bff;
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .email-body {
            padding: 20px;
            text-align: center;
        }
        .verification-code {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            border: 2px dashed #007bff;
            display: inline-block;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            Authentication Mail
        </div>
        <div class="email-body">
            <h3>Hello, {{ $name }}</h3>
            <p>Hello {{ $name }},</p>
            <p>Thank you for registering with us! To activate your account, please click the link below:</p>
            <a href="{{ $activationUrl }}">Activate My Account</a>
            <p>If you did not create this account, please ignore this email.</p>
        </div>
    </div>
</body>
</html>

