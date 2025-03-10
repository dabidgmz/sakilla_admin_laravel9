<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('Navbar')
    
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('index') }}" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Movie Rental</span>
        </a>
        @include('Sidebar')
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Inventory</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Inventory</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Inventory Data</h3>
                            </div>
                            <div class="card-body text-center">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addInventoryModal">
                                    <i class="fas fa-plus"></i> Agregar Customer
                                </button>
                            </div>
                            </div>
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Inventory ID</th>
                                            <th>Film ID</th>
                                            <th>Store ID</th>
                                            <th>Last Update</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inventoriData as $data)
                                        <tr>
                                            <td>{{ $data->inventory_id }}</td>
                                            <td>{{ $data->film_id }}</td>
                                            <td>{{ $data->store_id }}</td>
                                            <td>{{ $data->last_update }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editInventoryModal"
                                                    data-id="{{ $data->inventory_id }}"
                                                    data-film_id="{{ $data->film_id }}"
                                                    data-store_id="{{ $data->store_id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('inventories.destroy', $data->inventory_id) }}" method="POST" style="display: inline;">
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
                                        <li class="page-item {{ $inventoriData->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $inventoriData->previousPageUrl() }}">&laquo;</a>
                                        </li>

                                        {{-- Números de página --}}
                                        @for ($page = 1; $page <= $inventoriData->lastPage(); $page++)
                                            <li class="page-item {{ $page == $inventoriData->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $inventoriData->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endfor

                                        {{-- Botón Siguiente --}}
                                        <li class="page-item {{ $inventoriData ->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $inventoriData ->nextPageUrl() }}">&raquo;</a>
                                        </li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ChartJS Section -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Area Chart</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="areaChart" style="height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Line Chart</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('ControlSidebar')
    @include('Footer')
</div>

<!-- Modal -->
<div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInventoryModalLabel">Add New Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('inventories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Film ID -->
                    <div class="form-group">
                        <label for="film_id">Film</label>
                        <input type="text" class="form-control" id="film_id" name="film_id" placeholder="Enter Film ID" value="{{ old('film_id') }}" required>
                    </div>

                    <!-- Store ID -->
                    <div class="form-group">
                        <label for="store_id">Store</label>
                        <input type="text" class="form-control" id="store_id" name="store_id" placeholder="Enter Store ID" value="{{ old('store_id') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editInventoryModal" tabindex="-1" role="dialog" aria-labelledby="editInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInventoryModalLabel">Edit Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actorForm" method="POST">
                @csrf
                @method('PUT') <!-- Método PUT para la actualización -->
                <div class="modal-body">
                    <!-- Film ID -->
                    <div class="form-group">
                        <label for="film_id">Film</label>
                        <input type="text" class="form-control" id="film_id" name="film_id" value="{{ old('film_id')}}" required>
                    </div>

                    <!-- Store ID -->
                    <div class="form-group">
                        <label for="store_id">Store</label>
                        <input type="text" class="form-control" id="store_id" name="store_id" value="{{old('store_id') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>

<script>
    $(function () {
        // AREA CHART
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'Dataset 1',
                    backgroundColor: 'rgba(60,141,188,0.7)',
                    borderColor: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: 'Dataset 2',
                    backgroundColor: 'rgba(210, 214, 222, .7)',
                    borderColor: '#c1c7d1',
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };
        var areaChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: true
        };
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        });

        // LINE CHART
        var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
        var lineChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Dataset 1',
                fill: false,
                borderColor: 'rgba(60,141,188,1)',
                data: [28, 48, 40, 19, 86, 27, 90]
            }]
        };
        var lineChartOptions = {
            responsive: true,
            maintainAspectRatio: false
        };
        new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        });
    });
</script>

<script>
    $('#editInventoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var inventoryid = button.data('id');
        var film_id = button.data('film_id');
        var store_id = button.data('store_id');

        var modal = $(this);
        modal.find('.modal-body #inventory_id').val(inventoryid);
        modal.find('.modal-body #film_id').val(film_id);
        modal.find('.modal-body #store_id').val(store_id);
        modal.find('form').attr('action', '/inventories/' + inventoryid);
    });
</script>
</body>
</html>
