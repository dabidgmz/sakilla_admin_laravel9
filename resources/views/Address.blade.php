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
                                    <i class="fas fa-plus"></i> Add Address
                                </button>
                            </div>
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Address</th>
                                            <th>Address 2</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>P Code</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($addss as $address)
                                            <tr>
                                                <td>{{ $address->address_id }}</td>
                                                <td>{{ $address->address  ?? 'N/A' }}</td>
                                                <td>{{ $address->address2 ?? 'N/A' }}</td>
                                                <td>{{ $address->district  ?? 'N/A'}}</td>
                                                <td>{{ $address->city->name ?? 'N/A' }}</td>
                                                <td>{{ $address->postal_code  ?? 'N/A' }}</td>
                                                <td>{{ $address->phone  ?? 'N/A' }}</td>
                                                <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addresModalUpdate" 
                                                    data-id="{{ $address->address_id }}" 
                                                    data-address="{{ $address->address }}"
                                                    data-address2="{{ $address->address2 }}"
                                                    data-district="{{ $address->district }}"
                                                    data-city_id="{{ $address->city_id }}"
                                                    data-postal_code="{{ $address->postal_code }}"
                                                    data-phone="{{ $address->phone }}">
                                                    <i class="fas fa-edit"></i> Update
                                                </button>
                                                 <form action="{{ route('address.destroy', $address->address_id) }}" method="POST" style="display:inline;">
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
                                    <li class="page-item {{ $addss->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $addss->previousPageUrl() }}">&laquo;</a>
                                    </li>

                                    {{-- Números de página --}}
                                    @for ($page = 1; $page <= $addss->lastPage(); $page++)
                                        <li class="page-item {{ $page == $addss->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $addss->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor

                                    {{-- Botón Siguiente --}}
                                    <li class="page-item {{ $addss->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $addss->nextPageUrl() }}">&raquo;</a>
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

<!-- Modal de agregar Address -->
<div class="modal fade" id="actorModal" tabindex="-1" role="dialog" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="actorModalLabel">Add Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="actorForm" method="POST" action="{{ route('Address') }}"> 
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                    </div>

                    <div class="form-group">
                        <label for="address2">Address 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" value="{{ old('address2') }}">
                    </div>

                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" class="form-control" id="district" name="district" value="{{ old('district') }}">
                    </div>

                    <div class="form-group">
                        <label for="city_id">City ID</label>
                        <input type="text" class="form-control" id="city_id" name="city_id" value="{{ old('city_id') }}">
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
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

<!-- Modal de actualización de actor -->
<div class="modal fade" id="addresModalUpdate" tabindex="-1" role="dialog" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="actorModalLabel">Update Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="actorForm" method="POST"> 
            @csrf
            @method('PUT') 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                    </div>

                    <div class="form-group">
                        <label for="address2">Address 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" value="{{ old('address2') }}">
                    </div>

                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" class="form-control" id="district" name="district" value="{{ old('district') }}">
                    </div>

                    <div class="form-group">
                        <label for="city_id">City ID</label>
                        <input type="text" class="form-control" id="city_id" name="city_id" value="{{ old('city_id') }}">
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
    $('#addresModalUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var addressId = button.data('id');
        var address = button.data('address');
        var address2 = button.data('address2');
        var district = button.data('district');
        var cityId = button.data('city_id');
        var postalCode = button.data('postal_code');
        var phone = button.data('phone');


        var modal = $(this);
        modal.find('.modal-body #address_id').val(addressId);
        modal.find('.modal-body #address').val(address);
        modal.find('.modal-body #address2').val(address2);
        modal.find('.modal-body #district').val(district);
        modal.find('.modal-body #city_id').val(cityId);
        modal.find('.modal-body #postal_code').val(postalCode);
        modal.find('.modal-body #phone').val(phone);
        modal.find('form').attr('action', '/address/' + addressId);
    });
</script>
</body>
</html>
