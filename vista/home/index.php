<?php
$titulo = "Feme Accesorios";
include_once '../estructuras/cabecera.php';
?>

<div class="container">
    <div class="mt-5">
        <center>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../archivos/images/Rumy.jpeg" class="d-block w-50 overlay-dark" style="width: 100%; height: 500px;" alt="imagen de aritos">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Aritos Rumy</h5>
                            <a href="../cliente/aros.php"><p>Ver más</p></a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../../archivos/images/Susan.jpeg" class="d-block w-50 overlay-dark" style="width: 100%; height: 500px;" alt="imagen de collar">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Collar Susan</h5>
                            <a href="../cliente/cadenitas.php"><p>Ver más</p></a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../../archivos/images/Amon.jpeg" class="d-block w-50 overlay-dark" style="width: 100%; height: 500px;" alt="imagen de pulsera">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Pulsera Amón</h5>
                            <a href="../cliente/pulseras.php"><p>Ver más</p></a>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </center>
    </div>
</div>

<?php
include_once '../estructuras/pie.php';