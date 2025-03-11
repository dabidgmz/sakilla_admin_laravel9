<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rentals</title>

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
    <aside  class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(to bottom, #000000, #333333);" >
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
                        <h1 class="m-0">Rentals</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Rentals</li>
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
                                <h3 class="card-title">Rental Records</h3>
                                <div class="text-center">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addRentalModal">
                                        <i class="fas fa-plus"></i> Add Payment
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Rental Date</th>
                                            <th>Inventory ID</th>
                                            <th>Customer ID</th>
                                            <th>Return Date</th>
                                            <th>Staff ID</th>
                                            <th>Last Update</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rentals as $rental)
                                            <tr>
                                                <td>{{ $rental->rental_id }}</td>
                                                <td>{{ $rental->rental_date }}</td>
                                                <td>{{ $rental->inventory_id }}</td>
                                                <td>{{ $rental->customer_id }}</td>
                                                <td>{{ $rental->return_date }}</td>
                                                <td>{{ $rental->staff_id }}</td>
                                                <td>{{ $rental->last_update }}</td>
                                                <td>
                                                    <a  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRentalModal"
                                                        data-rental_id="{{ $rental->rental_id }}""
                                                        data-inventory_id="{{$rental->inventory_id }}"
                                                        data-customer_id="{{ $rental->customer_id }}"
                                                        data-return_date="{{ $rental->return_date }}"
                                                        data-staff_id="{{ $rental->staff_id }}"">
                                                        <i class="fas fa-edit"></i> Update
                                                    </a>
                                                    <form action="{{ route('rentals.destroy', $rental->rental_id) }}" method="POST" style="display: inline-block;">
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
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{-- Botón Anterior --}}
                                        <li class="page-item {{ $rentals->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $rentals->previousPageUrl() }}">&laquo;</a>
                                        </li>

                                        {{-- Números de página --}}
                                        @for ($page = 1; $page <= $rentals->lastPage(); $page++)
                                            <li class="page-item {{ $page == $rentals->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $rentals->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endfor

                                        {{-- Botón Siguiente --}}
                                        <li class="page-item {{ $rentals->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $rentals->nextPageUrl() }}">&raquo;</a>
                                        </li>
                                    </ul>
                            </div>
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
<div class="modal fade" id="addRentalModal" tabindex="-1" role="dialog" aria-labelledby="addRentalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRentalModalLabel">Add New Rental</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('rentals.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                
                    <!-- Inventory ID -->
                    <div class="form-group">
                        <label for="inventory_id">Inventory ID</label>
                        <input type="number" class="form-control" id="inventory_id" name="inventory_id" value="{{ old('$rental->inventory_id') }}" required>
                    </div>

                    <!-- Customer ID -->
                    <div class="form-group">
                        <label for="customer_id">Customer ID</label>
                        <input type="number" class="form-control" id="customer_id" name="customer_id" value="{{ old('$rental->customer_id') }}" required>
                    </div>

                    <!-- Staff ID -->
                    <div class="form-group">
                        <label for="staff_id">Staff ID</label>
                        <input type="number" class="form-control" id="staff_id" name="staff_id" value="{{ old('$rental->staff_id') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Rental</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editRentalModal" tabindex="-1" role="dialog" aria-labelledby="updateRentalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateRentalLabel">Update Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('rentals.update', $rental->rental_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                                    
                    <!-- Inventory ID -->
                    <div class="form-group">
                        <label for="inventory_id">Inventory ID</label>
                        <input type="number" class="form-control" id="inventory_id" name="inventory_id" value="{{ old('$rental->inventory_id') }}" required>
                    </div>

                    <!-- Customer ID -->
                    <div class="form-group">
                        <label for="customer_id">Customer ID</label>
                        <input type="number" class="form-control" id="customer_id" name="customer_id" value="{{ old('$rental->customer_id') }}" required>
                    </div>

                    <!-- Staff ID -->
                    <div class="form-group">
                        <label for="staff_id">Staff ID</label>
                        <input type="number" class="form-control" id="staff_id" name="staff_id" value="{{ old('$rental->staff_id') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Rental</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#editRentalModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var rental_id = button.data('rental_id');
        var inventory_id = button.data('inventory_id');
        var customer_id = button.data('customer_id');
        var staff_id = button.data('staff_id');
        
        var modal = $(this);
        modal.find('.modal-body #rental_id').val(rental_id);
        modal.find('.modal-body #edit_inventory_id').val(inventory_id);
        modal.find('.modal-body #edit_customer_id').val(customer_id);
        modal.find('.modal-body #edit_staff_id').val(staff_id);
        modal.find('form').attr('action', '/payments/' + payment_id );
    });
</script>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
