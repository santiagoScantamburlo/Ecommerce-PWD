<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap/boostrapValidator.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Cabecera redirect index php htdocs -->
    <title><?php echo $titulo; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark" style="background: rgb(194, 2, 160);background: linear-gradient(90deg, rgba(194, 2, 160, 1) 14%, rgba(131, 0, 133, 1) 100%, rgba(0, 212, 255, 1) 100%);">
            <div class="container-fluid">
                <a href="../home/index.php"><img src="../../assets/images/LogoFeme.png"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item dropdown offset-md-5">
                        </li>

                    <li class="nav-item dropdown offset-md-8">
                        </li>

                        <li class="nav-item dropdown">
                            <a class="navbar-brand" href="../home/index.php" aria-expanded="false">HOME</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../pages/aros.php">Aros</a></li>
                                <li><a class="dropdown-item" href="../pages/cadenitas.php">Cadenitas</a></li>
                                <li><a class="dropdown-item" href="../pages/pulseras.php">Pulseras</a></li>

                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ofertas</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../pages/información.php">Métodos de pago y envíos</a></li>
                                <li><a class="dropdown-item" href="../pages/cuidados.php">Cuidado de los productos</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Información</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../pages/información.php">Métodos de pago y envíos</a></li>
                                <li><a class="dropdown-item" href="../pages/cuidados.php">Cuidado de los productos</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown offset-md-3">
                        </li>

                        <!-- <li class="nav-item dropdown offset-md-11">
                        </li> -->

                        <li class="nav-item dropdown col-md-2 offset-md-11">
                            <a class="navbar-brand" href="../pages/cart.php" aria-expanded="false"><i class="bi bi-cart-fill"></i></a>
                        </li>

                        <li class="nav-item col-md-2">
                            <a class="navbar-brand" href="../pages/login.php" aria-expanded="false">Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main role="main">
        <?php
// include_once '../../../../configuracion.php';
?>
        </main>
    </header>