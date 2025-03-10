<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movies</title>

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
   @include('Films.add_films_modal')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"> Movie Rental</span>
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
                        <h1 class="m-0">Movies List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Movies List</li>
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
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">List of Films</h3>
                                <button class="btn btn-success mb-3 mx-auto" data-toggle="modal" data-target="#filmsModal">
                                    <i class="fas fa-plus"></i> Add Film
                                </button>
                            </div>
                            <div class="card-body">
                                <div style="max-height: 400px; overflow-y: auto; overflow-x: auto;">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Release Year</th>
                                                <th>Language</th>
                                                <th>Orgl Language</th>
                                                <th>Rntl Duration</th>
                                                <th>Rntl Rate</th>
                                                <th>Length</th>
                                                <th>Repcmnt Cost</th>
                                                <th>Rating</th>
                                                <th>Spcl Features</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($films as $film)
                                                <tr>
                                                    <td>{{ $film->film_id }}</td>
                                                    <td>{{ $film->title }}</td>
                                                    <td>{{ $film->description }}</td>
                                                    <td>{{ $film->release_year }}</td>
                                                    <td>{{ $film->language_id }}</td>
                                                    <td>{{ $film->original_language_id }}</td>
                                                    <td>{{ $film->rental_duration }}</td>
                                                    <td>{{ $film->rental_rate }}</td>
                                                    <td>{{ $film->length }}</td>
                                                    <td>{{ $film->replacement_cost }}</td>
                                                    <td>{{ $film->rating }}</td>
                                                    <td>{{ $film->special_features }}</td>
                                                    <td>
                                                       <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateFilmModal"
                                                            data-id="{{ $film->film_id }}"
                                                            data-title="{{ $film->title }}"
                                                            data-description="{{ $film->description }}"
                                                            data-release_year="{{ $film->release_year }}"
                                                            data-language_id="{{ $film->language_id }}"
                                                            data-original_language_id="{{ $film->original_language_id }}"
                                                            data-rental_duration="{{ $film->rental_duration }}"
                                                            data-rental_rate="{{ $film->rental_rate }}"
                                                            data-length="{{ $film->length }}"
                                                            data-replacement_cost="{{ $film->replacement_cost }}"
                                                            data-rating="{{ $film->rating }}"
                                                            data-special_features="{{ $film->special_features }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="{{ route('films.destroy', $film->film_id) }}" method="POST" style="display: inline;">
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
                                        <li class="page-item {{ $films->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $films->previousPageUrl() }}">&laquo;</a>
                                        </li>

                                        {{-- Números de página --}}
                                        @for ($page = 1; $page <= $films->lastPage(); $page++)
                                            <li class="page-item {{ $page == $films->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $films->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endfor

                                        {{-- Botón Siguiente --}}
                                        <li class="page-item {{ $films->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $films->nextPageUrl() }}">&raquo;</a>
                                        </li>
                                    </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('ControlSidebar')

    @include('Footer')
</div>
<!-- ./wrapper -->
<div class="modal fade" id="updateFilmModal" tabindex="-1" role="dialog" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="customerModalLabel">Update Film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="filmsForm" method="POST" >
            @csrf 
            @method('PUT')
            <div class="modal-body">                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="release_year">Release Year</label>
                    <input type="number" class="form-control" id="release_year" name="release_year" placeholder="Enter Year" value="{{ old('release_year') }}" required>
                </div>

                <div class="form-group">
                    <label for="language_id">Language</label>
                    <input type="text" class="form-control" id="language_id" name="language_id" value="{{ old('language_id') }}">
                    
                </div>

                <div class="form-group">
                    <label for="original_language_id">Original Language</label>
                    <imput type="text" class="form-control" id="original_language_id" name="original_language_id" value="{{ old('original_language_id') }}">
                </div>

                <div class="form-group">
                    <label for="rental_duration">Rental Duration (days)</label>
                    <input type="number" class="form-control" id="rental_duration" name="rental_duration" value="{{ old('rental_duration') }}" required>
                </div>

                <div class="form-group">
                    <label for="rental_rate">Rental Rate</label>
                    <input type="number" step="0.01" class="form-control" id="rental_rate" name="rental_rate" value="{{ old('rental_rate') }}" required>
                </div>

                <div class="form-group">
                    <label for="length">Length (minutes)</label>
                    <input type="number" class="form-control" id="length" name="length" value="{{ old('length') }}">
                </div>

                <div class="form-group">
                    <label for="replacement_cost">Replacement Cost</label>
                    <input type="number" step="0.01" class="form-control" id="replacement_cost" name="replacement_cost" value="{{ old('replacement_cost') }}" required>
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="">Select Rating</option>
                        <option value="G" {{ old('rating') == 'G' ? 'selected' : '' }}>G</option>
                        <option value="PG" {{ old('rating') == 'PG' ? 'selected' : '' }}>PG</option>
                        <option value="PG-13" {{ old('rating') == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                        <option value="R" {{ old('rating') == 'R' ? 'selected' : '' }}>R</option>
                        <option value="NC-17" {{ old('rating') == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="special_features">Special Features</label>
                    <input type="text" class="form-control" id="special_features" name="special_features" value="{{ old('special_features') }}">
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
    $('#updateFilmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var title = button.data('title');
        var description = button.data('description');
        var release_year = button.data('release_year');
        var language_id = button.data('language_id');
        var original_language_id = button.data('original_language_id');
        var rental_duration = button.data('rental_duration');
        var rental_rate = button.data('rental_rate');
        var length = button.data('length');
        var replacement_cost = button.data('replacement_cost');
        var rating = button.data('rating');
        var special_features = button.data('special_features');

        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #title').val(title);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #release_year').val(release_year);
        modal.find('.modal-body #language_id').val(language_id);
        modal.find('.modal-body #original_language_id').val(original_language_id);
        modal.find('.modal-body #rental_duration').val(rental_duration);
        modal.find('.modal-body #rental_rate').val(rental_rate);
        modal.find('.modal-body #length').val(length);
        modal.find('.modal-body #replacement_cost').val(replacement_cost);
        modal.find('.modal-body #rating').val(rating);
        modal.find('.modal-body #special_features').val(special_features);
        modal.find('form').attr('action', '/films/' + id);
    });
</script>
</body>
</html>
