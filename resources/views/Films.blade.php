<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movies</title>

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

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"> Movie Rental</span>
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
                        <h1 class="m-0">Movies List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Movies List</li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Films</h3>
                                <a href="#" class="btn btn-primary float-right">Add Film</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Release Year</th>
                                            <th>Language</th>
                                            <th>Orgl Language</th>
                                            <th>Rntl Duration</th>
                                            <th>Rntl Rate</th>
                                            <th>Length</th>
                                            <th>Repcmnt Cost</th>
                                            <th>Rating</th>
                                            <th>Spcl Features</th>
                                            <th>Last Update</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach($flims as $flim)
                                        <tr>
                                            <td>{{ $flim->flim_id }}</td>
                                            <td>{{ $flim->title }}</td>
                                            <td>{{ $flim->description }}</td>
                                            <td>{{ $flim->release_year }}</td>
                                            <td>{{ $flim->language_id }}</td>
                                            <td>{{ $flim->original_language_id }}</td>
                                            <td>{{ $flim->rental_duration }}</td>
                                            <td>{{ $flim->rental_rate }}</td>
                                            <td>{{ $flim->length }}</td>
                                            <td>{{ $flim->replacement_cost }}</td>
                                            <td>{{ $flim->rating }}</td>
                                            <td>{{ $flim->special_features }}</td>
                                            <td>{{ $flim->last_update }}</td>
                                            <td>
                                                <a href="{{ route('flims.edit', $flim->flim_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('flims.destroy', $flim->flim_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
