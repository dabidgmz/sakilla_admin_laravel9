<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actors</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="icon" href="{{ asset('dist/img/CinemaStudio.png') }}" type="image/x-icon">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

   @include('Navbar')

    <!-- Main Sidebar Container -->
    <aside  class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(to bottom, #000000, #333333);">
        <!-- Brand Logo -->
        <a href="{{ route('index') }}" class="brand-link">
        <img src="dist/img/CinemaStudio.png" alt="Cinema Studio Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cinema Studio</span>
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
                        <h1 class="m-0">Flim Actor Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Actors</li>
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
                        <!-- Actors Table -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Flim Actor List</h5>
                            </div>
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Actor</th>
                                            <th>Film ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($film_actors as $film_actor)
                                            <tr>
                                                <td>{{ $film_actor->actor->first_name }} {{ $film_actor->actor->last_name }}</td>
                                                <td>{{ $film_actor->film_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{-- Botón Anterior --}}
                                        <li class="page-item {{ $film_actors->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $film_actors->previousPageUrl() }}">&laquo;</a>
                                        </li>

                                        {{-- Números de página --}}
                                        @for ($page = 1; $page <= $film_actors->lastPage(); $page++)
                                            <li class="page-item {{ $page == $film_actors->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $film_actors->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endfor

                                        {{-- Botón Siguiente --}}
                                        <li class="page-item {{ $film_actors->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $film_actors->nextPageUrl() }}">&raquo;</a>
                                        </li>
                                    </ul>
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
