<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cinema Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <style>
    body {
        background-color:rgb(39, 38, 38);
        color: white;
        font-family: Arial, sans-serif;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background: rgb(27, 25, 25);
    }
    .logo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }
    .icons {
        display: flex;
        gap: 15px;
    }
    .swiper {
        width: 70%; /* Reducir el ancho */
        margin: auto;
        padding-top: 30px;
        padding-bottom: 30px;
    }
    .swiper-slide img {
        width: 20%;
        height: 250px; 
        border-radius: 10px;
        object-fit: cover; /* Asegura que la imagen se ajuste bien */
    }
    .movie-section {
        margin: 40px 0;
    }
    .movie-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
        border-left: 5px solid #e50914;
        padding-left: 10px;
    }
    .movie-card {
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        margin-bottom: 20px;
    }
    .movie-card:hover {
        transform: scale(1.1);
        box-shadow: 0px 10px 20px rgba(255, 255, 255, 0.2);
    }
    .movie-card img {
        width: 100%;
        height: 400px;
        object-fit: cover; 
    }
    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.7);
        padding: 10px;
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    .movie-card:hover .overlay {
        opacity: 1;
    }
    .tab-content {
        padding-top: 20px;
    }
    .btn {
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease-in-out;
    }
</style>
</head>
<body>
    <div class="header">
        <img src="dist/img/CinemaStudio.png" alt="Cinema Studio" class="logo">
        
    </div>
    
    <div class="d-flex justify-content-center">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide d-flex align-items-center">
                    <div class="text-white me-3">
                        <h3>Avatar</h3>
                        <p>Una aventura épica en un mundo alienígena.</p>
                    </div>
                    <img src="Movies/avatar.jpg" alt="Película 1" class="img-fluid">
                </div>
                <div class="swiper-slide d-flex align-items-center">
                    <div class="text-white me-3">
                        <h3>Star Wars</h3>
                        <p>La saga espacial más famosa de todos los tiempos.</p>
                    </div>
                    <img src="Movies/starkars.jpg" alt="Película 2" class="img-fluid">
                </div>
                <div class="swiper-slide d-flex align-items-center">
                    <div class="text-white me-3">
                        <h3>Soy Leyenda</h3>
                        <p>Un hombre lucha por sobrevivir en un mundo post-apocalíptico.</p>
                    </div>
                    <img src="Movies/soyleyenda.jpg" alt="Película 3" class="img-fluid">
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="container">
        
        <!-- Taps -->
        <ul class="nav nav-tabs justify-content-center" id="movieTabs" role="tablist" >
            <li class="nav-item" role="presentation">
            <a class="nav-link active text-white" id="horarios-tab" data-bs-toggle="tab" href="#horarios" role="tab" aria-controls="horarios" aria-selected="true" style="background-color: #444;">Horarios</a>
            </li>
            <li class="nav-item" role="presentation">
            <a class="nav-link text-white" id="cartelera-tab" data-bs-toggle="tab" href="#cartelera" role="tab" aria-controls="cartelera" aria-selected="false" style="background-color: #444;">Cartelera</a>
            </li>
        </ul>
        
        <div class="tab-content" id="movieTabsContent">
            <!-- Horarios Tab -->
            <div class="tab-pane fade show active" id="horarios" role="tabpanel" aria-labelledby="horarios-tab">
                <h2 class="movie-title">Horarios de las Películas</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="movie-card">
                            <img src="Movies/joker.jpg"" alt="Película 1">
                            <div class="overlay">
                                <p>Joker</p>
                                <p>10:00 AM, 2:00 PM, 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="movie-card">
                            <img src="Movies/soyleyenda.jpg" alt="Película 2">
                            <div class="overlay">
                                <p>Soy Leyenda</p>
                                <p>11:00 AM, 3:00 PM, 7:00 PM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="movie-card">
                            <img src="Movies/starkars.jpg" alt="Película 3">
                            <div class="overlay">
                                <p>Star Wars</p>
                                <p>12:00 PM, 4:00 PM, 8:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Cartelera Tab -->
            <div class="tab-pane fade" id="cartelera" role="tabpanel" aria-labelledby="cartelera-tab">
                <h2 class="movie-title">Cartelera de Películas</h2>
                <div class="row">
                    <div class="col-md-3">
                        <div class="movie-card">
                            <img src="Movies/avatar.jpg" alt="Película 1">
                            <div class="overlay">Avatar</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="movie-card">
                            <img src="Movies/guardainesdelagalaxia.jpg" alt="Película 2">
                            <div class="overlay">Guardianes de la Galaxia</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="movie-card">
                            <img src="Movies/infinitywar.jpg" alt="Película 3">
                            <div class="overlay">Infinity war</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="movie-card">
                            <img src="Movies/jhonwick3.jpg" alt="Película 4">
                            <div class="overlay">Jhon Wick 3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "slide",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
</body>
</html>
