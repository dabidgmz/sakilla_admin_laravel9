<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff</title>

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
        <a href="{{ route('index') }}" class="brand-link">
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
                        <h1 class="m-0">Staff</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Staff</li>
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
                                <h3 class="card-title">Staff Records</h3>
                                <div class="text-center">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addStaffModal">
                                        <i class="fas fa-plus"></i> Add Staff
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Store ID</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staff as $member)
                                            <tr>
                                                <td>{{ $member->staff_id }}</td>
                                                <td>{{ $member->first_name }}</td>
                                                <td>{{ $member->last_name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->username }}</td>
                                                <td>{{ $member->store_id }}</td>
                                                <td>{{ $member->active ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                {{-- <a class="btn btn-primary btn-sm editStaffBtn" data-toggle="modal" data-target="#editStaffModal"
                                                    data-id="{{ $member->staff_id }}"
                                                    data-first_name="{{ $member->first_name }}"
                                                    data-last_name="{{ $member->last_name }}"
                                                    data-address_id="{{ $member->address_id }}"
                                                    data-picture="{{ $member->picture }}"
                                                    data-email="{{ $member->email }}"
                                                    data-store_id="{{ $member->store_id }}"
                                                    data-active="{{ $member->active }}"
                                                    data-username="{{ $member->username }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a> --}}

                                                    <form action="{{ route('staff.destroy', $member->staff_id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Delete
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
                                        <li class="page-item {{ $staff->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $staff->previousPageUrl() }}">&laquo;</a>
                                        </li>

                                        {{-- Números de página --}}
                                        @for ($page = 1; $page <= $staff->lastPage(); $page++)
                                            <li class="page-item {{ $page == $staff->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $staff->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endfor

                                        {{-- Botón Siguiente --}}
                                        <li class="page-item {{ $staff->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $staff->nextPageUrl() }}">&raquo;</a>
                                        </li>
                                    </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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

<!-- Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStaffModalLabel">Add New Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                
                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    </div>

                    <!-- Address ID -->
                    <div class="form-group">
                        <label for="address_id">Address ID</label>
                        <input type="number" class="form-control" id="address_id" name="address_id" value="{{ old('address_id') }}" required>
                    </div>

                    <!-- Picture -->
                    <div class="form-group">
                        <label for="picture">Picture URL</label>
                        <input type="text" class="form-control" id="picture" name="picture" value="{{ old('picture') }}" >
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <!-- Store ID -->
                    <div class="form-group">
                        <label for="store_id">Store ID</label>
                        <input type="number" class="form-control" id="store_id" name="store_id" value="{{ old('store_id') }}" required>
                    </div>

                    <!-- Active -->
                    <div class="form-group">
                        <label for="active">Active</label>
                        <select class="form-control" id="active" name="active" required>
                            <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStaffModalLabel">Editar Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('staff.update', $member->staff_id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $member->staff_id }}">

                <div class="modal-body">
                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="first_name">Nombre</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" 
                            value="{{ old('first_name', $member->first_name) }}" required>
                    </div>

                    <!-- Apellido -->
                    <div class="form-group">
                        <label for="last_name">Apellido</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" 
                            value="{{ old('last_name', $member->last_name) }}" required>
                    </div>

                    <!-- Dirección -->
                    <div class="form-group">
                        <label for="address_id">Dirección</label>
                        <input type="number" class="form-control" id="address_id" name="address_id" 
                            value="{{ old('address_id', $member->address_id) }}" required>
                    </div>

                    <!-- Imagen (URL) -->
                    <div class="form-group">
                        <label for="picture">URL de Imagen</label>
                        <input type="text" class="form-control" id="picture" name="picture" 
                            value="{{ old('picture', $member->picture) }}">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" 
                            value="{{ old('email', $member->email) }}" required>
                    </div>

                    <!-- Tienda ID -->
                    <div class="form-group">
                        <label for="store_id">ID de Tienda</label>
                        <input type="number" class="form-control" id="store_id" name="store_id" 
                            value="{{ old('store_id', $member->store_id) }}" required>
                    </div>

                    <!-- Estado Activo -->
                    <div class="form-group">
                        <label for="active">Activo</label>
                        <select class="form-control" id="active" name="active">
                            <option value="1" {{ old('active', $member->active) == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('active', $member->active) == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Usuario -->
                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" 
                            value="{{ old('username', $member->username) }}" required>
                    </div>

                    <!-- Contraseña (Opcional) -->
                    <div class="form-group">
                        <label for="password">Contraseña (dejar en blanco para no cambiar)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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

<script>
    $('#editStaffModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var staff_id = button.data('staff_id');
        var first_name = button.data('first_name');
        var last_name = button.data('last_name');
        var address_id = button.data('address_id');
        var picture = button.data('picture');
        var email = button.data('email');
        var store_id = button.data('store_id');
        var active = button.data('active');
        var username = button.data('username');
        var password = button.data('password');
        
        var modal = $(this);
        modal.find('.modal-body #staff_id').val(staff_id);
        modal.find('.modal-body #first_name').val(first_name);
        modal.find('.modal-body #last_name').val(last_name);
        modal.find('.modal-body #address_id').val(address_id);
        modal.find('.modal-body #picture').val(picture);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #store_id').val(store_id);
        modal.find('.modal-body #active').val(active);
        modal.find('.modal-body #username').val(username);
        modal.find('.modal-body #password').val(password);
        modal.find('form').attr('action', '/staff/' + staff_id );
    });
</script>
</body>
</html>
