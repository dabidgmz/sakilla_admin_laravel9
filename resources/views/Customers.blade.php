<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers</title>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

   @include('Navbar')
   @include('Customer.add_customer_modal')
   @include('Customer.update_customer_modal')

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"> Movie Rental</span>
        </a>
        @include('Sidebar')
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Customers</h1>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Customer List</h3>
                        <button class="btn btn-success" data-toggle="modal" data-target="#customerModal">
                            <i class="fas fa-plus"></i> Agregar Customer
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                                        {{-- @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline;">
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
    </div>

    @include('ControlSidebar')
    @include('Footer')

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
