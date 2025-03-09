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
        <a href="{{ route('index') }}" class="brand-link">
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
                                <div class="table-responsive">
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
                                            @foreach($cities as $city)
                                                <tr>
                                                    <td>{{ $city->city_id }}</td>
                                                    <td>{{ $city->city }}</td>
                                                    <td>{{ $city->country->country }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm view-details"
                                                            data-country="{{ $city->country->country }}"
                                                            data-country-id="{{ $city->country->iso_code }}">
                                                            View Details
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Paginación fuera de la tabla -->
                        <div class="card-footer">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item {{ $cities->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $cities->previousPageUrl() }}">&laquo;</a>
                                </li>
                                @foreach ($cities->getUrlRange(1, $cities->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $cities->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ $cities->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $cities->nextPageUrl() }}">&raquo;</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Sección para mostrar detalles del país -->
                        <div id="country-details" class="card mt-4" style="display: none;">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title">Country Details</h3>
                            </div>
                            <div class="card-body">
                                <p><strong>Country:</strong> <span id="detail-country"></span></p>

                                <!-- Mapa dinámico -->
                                <div id="map-container" style="height: 400px; width: 100%;"></div>
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

<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Contenedor para el mapa -->
<script>
    // Inicializar el mapa
    function initMap() {
        $('#map-container').vectorMap({
            map: 'world_en',  // Mapa mundial
            backgroundColor: '#ffffff',  // Color de fondo
            color: '#e4e4e4',  // Color por defecto de los países
            hoverOpacity: 0.7,  // Opacidad al pasar el mouse sobre un país
            selectedColor: '#ff0000',  // Color cuando se selecciona un país
            enableZoom: true,  // Habilitar zoom
            showTooltip: true,  // Mostrar tooltip con el nombre del país
            onRegionClick: function(event, code, region) {
                // Llamada cuando se hace clic en un país
                alert('Has seleccionado: ' + region);
            }
        });
    }

    // Función para resaltar todos los países correspondientes al país seleccionado
    function highlightCountry(countryCode) {
        // Resaltar todos los países con el código de país seleccionado
        $('#map-container').vectorMap('set', 'focus', countryCode);
        $('#map-container').vectorMap('set', 'regionStyle', {
            initial: {
                fill: '#ff0000', // Color rojo al seleccionar el país
                stroke: '#000000', // Contorno negro
                "stroke-width": 1 // Grosor del contorno
            }
        });
    }

    // Función para mostrar los detalles del país y resaltar el contorno
    function showCountryDetails(countryName, countryCode) {
        // Mostrar la sección de detalles
        $('#country-details').show();
        $('#detail-country').text(countryName);

        // Resaltar todos los países que coincidan con el código ISO
        highlightCountry(countryCode);
    }

    // Añadir el evento de clic en el botón de "View Details"
    $(document).on('click', '.view-details', function() {
        var countryName = $(this).data('country');
        var countryCode = $(this).data('country-id');
        showCountryDetails(countryName, countryCode);
    });

    // Inicializar el mapa al cargar la página
    initMap();
</script>

</body>
</html>
