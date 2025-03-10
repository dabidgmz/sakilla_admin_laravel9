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
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('Navbar')
    @include('Actors.add_actor_modal')
    
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"> Movie Rental</span>
        </a>

        @include('Sidebar')
    </aside>
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Actors Management</h1>
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
                                <h5 class="m-0">Actors List</h5>
                                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#actorModal">
                                    <i class="fas fa-plus"></i> Agregar Actor
                                </button>
                            </div>
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($actors as $actor)
                                        <tr>
                                            <td>{{ $actor->actor_id }}</td>
                                            <td>{{ $actor->first_name }}</td>
                                            <td>{{ $actor->last_name }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#actorModalUpdate" 
                                                        data-id="{{ $actor->actor_id }}" 
                                                        data-first_name="{{ $actor->first_name }}" 
                                                        data-last_name="{{ $actor->last_name }}">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                 <form action="{{ route('actors.destroy', $actor->actor_id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{-- Botón Anterior --}}
                                    <li class="page-item {{ $actors->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $actors->previousPageUrl() }}">&laquo;</a>
                                    </li>

                                    {{-- Números de página --}}
                                    @for ($page = 1; $page <= $actors->lastPage(); $page++)
                                        <li class="page-item {{ $page == $actors->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $actors->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor

                                    {{-- Botón Siguiente --}}
                                    <li class="page-item {{ $actors->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $actors->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    @include('ControlSidebar')

    @include('Footer')
</div>
<!-- ./wrapper -->

<!-- Modal de actualización de actor -->
<div class="modal fade" id="actorModalUpdate" tabindex="-1" role="dialog" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actorModalLabel">Actualizar Actor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para actualizar actor -->
                <form id="updateActorForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Actor</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
    $('#actorModalUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var actorId = button.data('id'); 
        var firstName = button.data('first_name'); 
        var lastName = button.data('last_name'); 

        var modal = $(this);
        modal.find('.modal-body #first_name').val(firstName);
        modal.find('.modal-body #last_name').val(lastName);
        modal.find('form').attr('action', '/actors/' + actorId);
    });
</script>
</body>
</html>
