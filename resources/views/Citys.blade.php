<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>City List</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('Navbar')

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">City Management</span>
        </a>
        @include('Sidebar')
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">List of Cities</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Cities</li>
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
                                <h3 class="card-title">List of Cities and Countries</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>City Name</th>
                                            <th>Country</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>New York</td>
                                            <td>United States</td>
                                            <td>
                                                <button class="btn btn-info btn-sm view-details" 
                                                    data-city="New York" 
                                                    data-country="United States" 
                                                    data-country-id="US">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>London</td>
                                            <td>United Kingdom</td>
                                            <td>
                                                <button class="btn btn-info btn-sm view-details" 
                                                    data-city="London" 
                                                    data-country="United Kingdom" 
                                                    data-country-id="GB">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Tokyo</td>
                                            <td>Japan</td>
                                            <td>
                                                <button class="btn btn-info btn-sm view-details" 
                                                    data-city="Tokyo" 
                                                    data-country="Japan" 
                                                    data-country-id="JP">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Paris</td>
                                            <td>France</td>
                                            <td>
                                                <button class="btn btn-info btn-sm view-details" 
                                                    data-city="Paris" 
                                                    data-country="France" 
                                                    data-country-id="FR">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Berlin</td>
                                            <td>Germany</td>
                                            <td>
                                                <button class="btn btn-info btn-sm view-details" 
                                                    data-city="Berlin" 
                                                    data-country="Germany" 
                                                    data-country-id="DE">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- <tbody>
                                        {{--@foreach($cities as $city)
                                            <tr>
                                                <td>{{ $city->city_id }}</td>
                                                <td>{{ $city->city }}</td>
                                                <td>{{ $city->country->country }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm view-details"
                                                        data-city="{{ $city->city }}"
                                                        data-country="{{ $city->country->country }}"
                                                        data-country-id="{{ $city->country->country_id }}">
                                                        View Details
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody> -->
                                </table>
                            </div>
                        </div>

                        <!-- Sección para mostrar detalles del país -->
                        <div id="country-details" class="card mt-4" style="display: none;">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title">Country Details</h3>
                            </div>
                            <div class="card-body">
                                <p><strong>City:</strong> <span id="detail-city"></span></p>
                                <p><strong>Country:</strong> <span id="detail-country"></span></p>
                                <p><strong>Country Code:</strong> <span id="detail-country-id"></span></p>
                                
                                <!-- Mapa dinámico -->
                                <div id="map-container" style="height: 300px; width: 100%;"></div>
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- JQVMap Scripts -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<script>
    $(document).ready(function () {
        $(".view-details").click(function () {
            var city = $(this).data("city");
            var country = $(this).data("country");
            var countryId = $(this).data("country-id");

            $("#detail-city").text(city);
            $("#detail-country").text(country);
            $("#detail-country-id").text(countryId);

            $("#country-details").fadeIn();

            // Limpiar y cargar nuevo mapa con colores oscuros
            $('#map-container').html('');
            $('#map-container').vectorMap({
                map: 'world_en',
                backgroundColor: '#000000', 
                color: '#444', 
                hoverColor: '#ffcc00',
                selectedColor: '#ff0000', 
                borderColor: '#ffffff', 
                enableZoom: true,
                showTooltip: true,
                selectedRegions: [countryId]
            });
        });
    });
</script>


</body>
</html>
