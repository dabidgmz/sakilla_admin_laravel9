<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />

    <style>
        #map, #map2 {
            height: 350px;
            width: 100%;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
    </style>
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
                            <h1 class="m-0">Stores</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Stores</li>
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
                                    <h3 class="card-title">Store Records</h3>
                                </div>
                                <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Store ID</th>
                                            <th>Manager Staff ID</th>
                                            <th>Address ID</th>
                                            <th>Last Update</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stores as $store)
                                            <tr>
                                                <td>{{ $store->store_id }}</td>
                                                <td>{{ $store->manager_staff_id }}</td>
                                                <td>{{ $store->address_id }}</td>
                                                <td>{{ $store->last_update }}</td>                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Store Locations (Laravel)</h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Select a Location (MySQL)</h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="map2"></div>
                                            <p id="coords"></p>
                                        </div>
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

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <!-- Leaflet JS desde CDNJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Inicializa el primer mapa (Laravel)
            var map = L.map('map').setView([40.7128, -74.0060], 5); // Oficina de Laravel (Nueva York)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Lista de tiendas con coordenadas de Laravel
            var stores = [
                { name: "123 Laravel St, New York", lat: 40.7128, lng: -74.0060 },
                { name: "456 Laravel Blvd, NY", lat: 40.7306, lng: -73.9352 }
            ];

            // Agrega los marcadores en el mapa de Laravel
            stores.forEach(store => {
                L.marker([store.lat, store.lng]).addTo(map)
                    .bindPopup(store.name)
                    .openPopup();
            });

            // Inicializa el segundo mapa (MySQL)
            var map2 = L.map('map2').setView([25.532861, -103.322991], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map2);

            var marker;

            map2.on('click', function (e) {
                if (marker) { map2.removeLayer(marker); }
                marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map2);
                document.getElementById('coords').innerText = `Lat: ${e.latlng.lat}, Lng: ${e.latlng.lng}`;
            });
        });
    </script>

</body>

</html>
