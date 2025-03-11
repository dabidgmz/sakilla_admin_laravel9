<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers</title>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="icon" href="{{ asset('dist/img/CinemaStudio.png') }}" type="image/x-icon">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

   @include('Navbar')
   @include('Customer.add_customer_modal')
   @include('Customer.update_customer_modal')

    <aside  class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(to bottom, #000000, #333333);">
        <a href="{{ route('index') }}" class="brand-link">
        <img src="dist/img/CinemaStudio.png" alt="Cinema Studio Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cinema Studio</span>
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
                            <i class="fas fa-plus"></i> Add Customer
                        </button>
                    </div>

                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
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
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateCustomerModal"
                                        data-id="{{ $customer->customer_id }}"
                                        data-first_name="{{ $customer->first_name }}"
                                        data-last_name="{{ $customer->last_name }}"
                                        data-email="{{ $customer->email }}"
                                        data-active="{{ $customer->active }}">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                    <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
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
                            <li class="page-item {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $customers->previousPageUrl() }}">&laquo;</a>
                            </li>

                            {{-- Números de página --}}
                            @for ($page = 1; $page <= $customers->lastPage(); $page++)
                                <li class="page-item {{ $page == $customers->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $customers->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            {{-- Botón Siguiente --}}
                            <li class="page-item {{ $customers->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $customers->nextPageUrl() }}">&raquo;</a>
                            </li>
                        </ul>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    @include('ControlSidebar')
    @include('Footer')

</div>

<div class="modal fade" id="updateCustomerModal" tabindex="-1" role="dialog" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="customerModalLabel">Update Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="actorForm" method="POST"> 
            @csrf
            @method('PUT') 
            <div class="modal-body">
               {{-- <input type="hidden" name="_method" id="method_field" value="POST"> 
                <input type="hidden" id="customer_id" name="customer_id"> --}}

                <div class="form-group">
                        <label for="store_id">Store ID</label>
                        <input type="text" class="form-control" id="store_id" name="store_id" placeholder="Enter Store ID" value="{{ old('store_id') }}" required>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                        <label for="address_id">Address ID</label>
                        <input type="text" class="form-control" id="address_id" name="address_id" placeholder="Enter address ID" value="{{ old('address_id') }}" required>
                </div>

                <div class="form-group">
                    <label for="active">Active</label>
                    <select class="form-control" id="active" name="active">
                        <option value="1" {{ old('active') == "1" ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('active') == "0" ? 'selected' : '' }}>Inactive</option>
                    </select>
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


<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
    $('#updateCustomerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var customerid = button.data('id');
        var first_name = button.data('first_name');
        var last_name = button.data('last_name');
        var email = button.data('email');
        var active = button.data('active');


        var modal = $(this);
        modal.find('.modal-body #customer_id').val(customerid);
        modal.find('.modal-body #first_name').val(first_name);
        modal.find('.modal-body #last_name').val(last_name);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #active').val(active);
        modal.find('form').attr('action', '/customers/' + customerid);
    });
</script>
</body>
</html>
