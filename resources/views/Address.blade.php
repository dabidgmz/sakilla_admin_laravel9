<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Address</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('Navbar')
    @include('Addres.add_address_modal')

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Movie Rental</span>
        </a>

        @include('Sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Address Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Address</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Address Table -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Address List</h5>
                                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#actorModal">
                                    <i class="fas fa-plus"></i> Agregar Address
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Address</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Postal Code</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{--@foreach ($addresses as $address)
                                            <tr>
                                                <td>{{ $address->address_id }}</td>
                                                <td>{{ $address->address }}</td>
                                                <td>{{ $address->district }}</td>
                                                <td>{{ $address->city->name }}</td>
                                                <td>{{ $address->postal_code }}</td>
                                                <td>{{ $address->phone }}</td>
                                                <td>{{ $address->location }}</td>
                                                <td>
                                                    <a href="{{ route('addresses.edit', $address->address_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('addresses.destroy', $address->address_id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('ControlSidebar')
    @include('Footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
