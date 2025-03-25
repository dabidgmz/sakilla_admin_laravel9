<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="icon" href="{{ asset('dist/img/CinemaStudio.png') }}" type="image/x-icon">
</head>
<body>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset('dist/img/user4-128x128.jpg') }}" 
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"></h3>

                            <p class="text-muted text-center">Customer</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Store</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-envelope mr-1"></i></strong>
                            <p class="text-muted"></p>
                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                            <p class="text-muted"></p>

                            <hr>

                            <strong><i class="fas fa-store mr-1"></i> Store</strong>
                            <p class="text-muted"></p>

                            <hr>

                            <strong><i class="fas fa-calendar mr-1"></i> Created At</strong>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#actorModalUpdate" >
            <i class="fas fa-edit"></i> Update
        </button>
    </section>
</body>
</html>
