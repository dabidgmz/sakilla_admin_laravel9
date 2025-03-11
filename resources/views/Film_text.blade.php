<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Film text</title>

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
        <a href="{{ route('index') }} class="brand-link">
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
                        <h1 class="m-0">Flim Text Management</h1>
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
                                <h5 class="m-0">Flim Text List</h5>
                                <!-- <button class="btn btn-success mb-3" data-toggle="modal" data-target="#filmTextModal">
                                    <i class="fas fa-plus"></i> Agregar Address
                                </button> -->
                            </div>
                            <div  class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($filmTxt as $film_txt)
                                            <tr>
                                                <td>{{ $film_txt->film_id }}</td>
                                                <td>{{ $film_txt->title }}</td>
                                                <td>{{ $film_txt->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div  class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{-- Botón Anterior --}}
                                    <li class="page-item {{ $filmTxt->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $filmTxt->previousPageUrl() }}">&laquo;</a>
                                    </li>

                                    {{-- Números de página --}}
                                    @for ($page = 1; $page <= $filmTxt->lastPage(); $page++)
                                        <li class="page-item {{ $page == $filmTxt->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $filmTxt->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor

                                    {{-- Botón Siguiente --}}
                                    <li class="page-item {{ $filmTxt->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $filmTxt->nextPageUrl() }}">&raquo;</a>
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
<!-- Modal -->
<div class="modal fade" id="filmTextModal" tabindex="-1" role="dialog" aria-labelledby="filmTextModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="filmTextModalLabel">Add Film Text</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="filmTextForm" method="POST" action="{{ route('Film_text') }}">
                @csrf
                <div class="modal-body">
                <div class="form-group">
                        <label for="film_id">Film ID</label>
                        <input type="text" class="form-control" id="film_id" name="film_id" value="{{ old('film_id') }}" required>
                </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
