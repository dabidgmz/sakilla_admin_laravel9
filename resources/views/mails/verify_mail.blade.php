<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Auth Mail</title>
</head>
<body>
    <div>
        <h3>Hello, {{ $name }}</h3>
        <p>Your activation code is: {{ $verificationCode }}</p>
    </div>
</body>
</html>