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
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('Navbar')

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> Movie Rental</span>
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
                                <div class="card-header">
                                    <h3 class="card-title">Payment Records</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Staff</th>
                                                <th>Rental ID</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Last Update</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->payment_id }}</td>
                                                    <td>{{ $payment->customer_id }}</td>
                                                    <td>{{ $payment->staff_id }}</td>
                                                    <td>{{ $payment->rental_id }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    <td>{{ $payment->payment_date }}</td>
                                                    <td>{{ $payment->last_update }}</td>
                                                    <td>
                                                        <a href="{{ route('payments.edit', $payment->payment_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST" style="display:inline;">
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
</body>

</html>
