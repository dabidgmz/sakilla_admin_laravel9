<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payments</title>

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
            <a href="{{ route('index') }}" class="brand-link">
            <img src="dist/img/CinemaStudio.png" alt="Cinema Studio Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Cinema Studio</span>
            </a>
            @include('Sidebar')
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Payments Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Payments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Payment Records</h3>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addPaymentModal">
                                    <i class="fas fa-plus"></i> Add Payment
                                </button>
                                </div>
                                <!-- /.card-header -->
                                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer</th>
                                                <th>Staff</th>
                                                <th>Rental ID</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->payment_id }}</td>
                                                    <td>{{ $payment->customer_id }}</td>
                                                    <td>{{ $payment->staff_id }}</td>
                                                    <td>{{ $payment->rental_id }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    <td>{{ $payment->payment_date }}</td>
                                                    <td>
                                                        <button class="btn btn-warning" data-toggle="modal" data-target="#updatePaymentModal"
                                                            data-payment_id="{{ $payment->payment_id }}"
                                                            data-customer_id="{{ $payment->customer_id }}"
                                                            data-staff_id="{{ $payment->staff_id }}"
                                                            data-rental_id="{{ $payment->rental_id }}"
                                                            data-amount="{{ $payment->amount }}">
                                                            <i class="fas fa-edit"></i> Update
                                                        </button>
                                                        <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
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
                                        <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $payments->previousPageUrl() }}">&laquo;</a>
                                        </li>

                                        {{-- Números de página --}}
                                        @for ($page = 1; $page <= $payments->lastPage(); $page++)
                                            <li class="page-item {{ $page == $payments->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $payments->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endfor

                                        {{-- Botón Siguiente --}}
                                        <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $payments->nextPageUrl() }}">&raquo;</a>
                                        </li>
                                    </ul>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Line chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i> Line Chart
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div id="line-chart" style="height: 300px;"></div>
                                </div>
                            </div>

                            <!-- Area chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i> Area Chart
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div id="area-chart" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Bar chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i> Bar Chart
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div id="bar-chart" style="height: 300px;"></div>
                                </div>
                            </div>

                            <!-- Donut chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i> Donut Chart
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div id="donut-chart" style="height: 300px;"></div>
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
<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">Add New Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Customer ID -->
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <input type="number" class="form-control" id="customer_id" name="customer_id" placeholder="Enter Customer ID" value="{{ old('customer_id') }}" required>
                    </div>

                    <!-- Staff ID -->
                    <div class="form-group">
                        <label for="staff_id">Staff</label>
                        <input type="number" class="form-control" id="staff_id" name="staff_id" placeholder="Enter Staff ID" value="{{ old('staff_id') }}" required>
                    </div>

                    <!-- Rental ID -->
                    <div class="form-group">
                        <label for="rental_id">Rental</label>
                        <input type="number" class="form-control" id="rental_id" name="rental_id" placeholder="Enter Rental ID" value="{{ old('rental_id') }}" required>
                    </div>

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{ old('amount') }}" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="updatePaymentModal" tabindex="-1" role="dialog" aria-labelledby="updatePaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePaymentModalLabel">Update Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actorForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Customer ID -->
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <input type="number" class="form-control" id="customer_id" name="customer_id" value="{{ $payment->customer_id }}" required>
                    </div>

                    <!-- Staff ID -->
                    <div class="form-group">
                        <label for="staff_id">Staff</label>
                        <input type="number" class="form-control" id="staff_id" name="staff_id" value="{{ $payment->staff_id }}" required>
                    </div>

                    <!-- Rental ID -->
                    <div class="form-group">
                        <label for="rental_id">Rental</label>
                        <input type="number" class="form-control" id="rental_id" name="rental_id" value="{{ $payment->rental_id }}" required>
                    </div>

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $payment->amount }}" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- REQUIRED SCRIPTS -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/flot/jquery.flot.js"></script>
    <script src="plugins/flot/plugins/jquery.flot.resize.js"></script>
    <script src="plugins/flot/plugins/jquery.flot.pie.js"></script>
    <script src="dist/js/demo.js"></script>

    <script>
        $(function () {
            // Line Chart Data
            var line_data = {
                data: [[1, 10], [2, 15], [3, 25], [4, 30], [5, 40]],
                color: '#3c8dbc'
            };
            $.plot('#line-chart', [line_data], {
                grid: {
                    hoverable: true,
                    borderColor: '#f3f3f3',
                    borderWidth: 1,
                    tickColor: '#f3f3f3'
                },
                series: {
                    shadowSize: 0,
                    lines: { show: true },
                    points: { show: true }
                },
                lines: { fill: false, color: '#3c8dbc' },
                xaxis: { show: true },
                yaxis: { show: true }
            });

            // Area Chart Data
            var area_data = [[1, 10], [2, 20], [3, 25], [4, 30], [5, 50], [6, 70]];
            $.plot('#area-chart', [area_data], {
                grid: { borderWidth: 0 },
                series: {
                    shadowSize: 0,
                    color: '#00c0ef',
                    lines: { fill: true }
                },
                yaxis: { show: false },
                xaxis: { show: false }
            });

            // Bar Chart Data
            var bar_data = {
                data: [[1, 5], [2, 10], [3, 20], [4, 30], [5, 40]],
                bars: { show: true }
            };
            $.plot('#bar-chart', [bar_data], {
                grid: {
                    borderWidth: 1,
                    borderColor: '#f3f3f3',
                    tickColor: '#f3f3f3'
                },
                series: {
                    bars: {
                        show: true, barWidth: 0.5, align: 'center'
                    }
                },
                colors: ['#3c8dbc'],
                xaxis: { ticks: [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May']] }
            });

            // Donut Chart Data
            var donut_data = [
                { label: 'Payment Method 1', data: 40, color: '#3c8dbc' },
                { label: 'Payment Method 2', data: 30, color: '#0073b7' },
                { label: 'Payment Method 3', data: 30, color: '#00c0ef' }
            ];
            $.plot('#donut-chart', donut_data, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.5,
                        label: { show: true }
                    }
                },
                legend: { show: false }
            });
        });
    </script>

<script>
    $('#updatePaymentModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var payment_id = button.data('payment_id');
        var customer_id = button.data('customer_id');
        var staff_id = button.data('staff_id');
        var rental_id = button.data('rental_id');
        var amount = button.data('amount');

        var modal = $(this);
        modal.find('.modal-body #payment_id').val(payment_id);
        modal.find('.modal-body #customer_id').val(customer_id);
        modal.find('.modal-body #staff_id').val(staff_id);
        modal.find('.modal-body #rental_id').val(rental_id);
        modal.find('.modal-body #amount').val(amount);
        modal.find('form').attr('action', '/payments/' + payment_id );
    });
</script>
</body>

</html>
